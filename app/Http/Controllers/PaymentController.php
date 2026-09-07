<?php

namespace App\Http\Controllers;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createPreference($orderId)
    {
        try {
            // Configurar SDK con el Access Token
            MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

            $order = Order::with('items.product')->findOrFail($orderId);

            // Crear cliente de preferencia
            $client = new PreferenceClient();

            // Preparar items
            $items = [];

            foreach ($order->items as $item) {
                $product = $item->product;

                $items[] = [
                    'id' => (string) $product->id,
                    'title' => $product->name,
                    'quantity' => (int) $item->quantity,
                    'unit_price' => (float) $product->price,
                    'currency_id' => 'ARS'
                ];
            }

            // Datos del comprador
            $payer = [
                'email' => Auth::user()->email
            ];

            // URLs de retorno
            $backUrls = [
                'success' => url('/payment/success'),
                'failure' => url('/payment/failure'),
                'pending' => url('/payment/pending'),
            ];

            // Crear preferencia
            $preference = $client->create([
                'items' => $items,
                'payer' => $payer,
                'back_urls' => $backUrls,
                'external_reference' => (string) $order->id,
            ]);

            // Ir a Mercado Pago
            return redirect($preference->init_point);

        } catch (\Throwable $e) {

            dd([
                'mensaje' => $e->getMessage(),
                'status' => method_exists($e, 'getStatusCode') 
                    ? $e->getStatusCode() 
                    : null,
                'respuesta' => method_exists($e, 'getApiResponse')
                    ? $e->getApiResponse()->getContent()
                    : null
            ]);
        }
    }


    public function success(Request $request)
    {
        $paymentId = $request->payment_id;
        $externalReference = $request->external_reference;

        $order = Order::find($externalReference);

        if ($order) {
            $order->status = 'pagado';
            $order->payment_id = $paymentId;
            $order->save();
        }

        return view('payment.success', compact('order'));
    }


    public function failure(Request $request)
    {
        return view('payment.failure');
    }


    public function pending(Request $request)
    {
        return view('payment.pending');
    }


    public function webhook(Request $request)
    {
        $data = $request->all();

        Log::info('Webhook MP:', $data);

        return response()->json([
            'status' => 'ok'
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('services.index', compact('services'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $user = Auth::user();
        $service = Service::findOrFail($request->service_id);

        $existing = Service::where('user_id', $user->id)
            ->where('service_name', $service->service_name)
            ->where('status', 'activo')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Ya tenés este servicio contratado');
        }

        Service::create([
            'user_id' => $user->id,
            'product_id' => null,
            'service_name' => $service->service_name,
            'contract_date' => now(),
            'price' => $service->price,
            'status' => 'activo'
        ]);

        return redirect()->route('profile.edit')->with('success', '✅ Servicio contratado correctamente');
    }

    public function cancel($id)
    {
        $service = Service::where('user_id', Auth::id())->findOrFail($id);
        $service->status = 'cancelado';
        $service->save();

        return redirect()->back()->with('success', '❌ Servicio cancelado');
    }
}
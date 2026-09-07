<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar o crear usuario
        $user = User::where('email', 'juan@ecotech.com')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Juan Pérez',
                'email' => 'juan@ecotech.com',
                'password' => bcrypt('user123'),
                'role' => 'user'
            ]);
        }

        $services = [
            [
                'name' => 'WiFi 300 Mbps',
                'slug' => 'wifi-300-mbps',
                'category' => 'Internet',
                'description' => 'Internet de alta velocidad con tecnología WiFi 6. Incluye router gratuito y soporte 24/7.',
                'price' => 29.99,
                'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400',
                'eco_feature' => 'Bajo consumo energético',
                'is_active' => true,
                'stock' => 999
            ],
            [
                'name' => 'Fibra Óptica 1 Gbps',
                'slug' => 'fibra-optica-1gbps',
                'category' => 'Internet',
                'description' => 'Fibra óptica simétrica de 1 Gbps para gaming, streaming 4K y trabajo remoto.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1592136953339-18ab0ac9c4c4?w=400',
                'eco_feature' => 'Infraestructura sostenible',
                'is_active' => true,
                'stock' => 999
            ],
            [
                'name' => '5G Móvil Ilimitado',
                'slug' => '5g-movil-ilimitado',
                'category' => 'Móvil',
                'description' => 'Plan 5G con datos ilimitados, llamadas y mensajes ilimitados. Roaming en 50 países.',
                'price' => 39.99,
                'image' => 'https://images.unsplash.com/photo-1611162616305-c69b3fa7fbe0?w=400',
                'eco_feature' => 'Dispositivos eficientes',
                'is_active' => true,
                'stock' => 999
            ],
            [
                'name' => 'WiFi Mesh 600 Mbps',
                'slug' => 'wifi-mesh-600-mbps',
                'category' => 'Internet',
                'description' => 'Sistema WiFi Mesh con 3 nodos para cobertura total en toda la casa.',
                'price' => 39.99,
                'image' => 'https://images.unsplash.com/photo-1544198365-f5d60b6d8190?w=400',
                'eco_feature' => 'Materiales reciclados',
                'is_active' => true,
                'stock' => 999
            ],
            [
                'name' => 'Internet Satelital',
                'slug' => 'internet-satelital',
                'category' => 'Internet',
                'description' => 'Conexión satelital de alta velocidad para zonas rurales. Velocidad de 100 Mbps.',
                'price' => 59.99,
                'image' => 'https://images.unsplash.com/photo-1581092335871-5c7a3b0f0f8c?w=400',
                'eco_feature' => 'Energía solar',
                'is_active' => true,
                'stock' => 999
            ],
            [
                'name' => 'Plan Familiar 5G',
                'slug' => 'plan-familiar-5g',
                'category' => 'Móvil',
                'description' => '4 líneas móviles con datos compartidos de 200GB, llamadas y mensajes ilimitados.',
                'price' => 79.99,
                'image' => 'https://images.unsplash.com/photo-1611162617263-4ec3060a2b1e?w=400',
                'eco_feature' => 'Compensación de carbono',
                'is_active' => true,
                'stock' => 999
            ]
        ];

        foreach ($services as $data) {
            // Crear el servicio (plan) en la tabla services
            Service::create([
                'user_id' => $user->id,
                'product_id' => null,
                'service_name' => $data['name'],
                'contract_date' => now(),
                'price' => $data['price'],
                'status' => 'activo'
            ]);
        }
    }
}
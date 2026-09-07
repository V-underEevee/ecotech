<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

    Product::create([
            'name' => 'Auriculares EcoBamboo',
            'slug' => 'auriculares-ecobamboo',
            'description' => 'Auriculares Bluetooth con carcasa de bambú sostenible. Materiales 100% biodegradables, sonido de alta calidad y batería de 20 horas de duración.',
            'price' => 89.99,
            'image' => 'https://www.elarcadenoedetalles.com/2890-large_default/auriculares-inalambricos-con-caja-de-bambu-.jpg',
            'category' => 'Audio',
            'eco_feature' => 'Materiales biodegradables',
            'is_active' => true,
            'stock' => 50
        ]);

        Product::create([
            'name' => 'Cargador Solar Portátil',
            'slug' => 'cargador-solar-portatil',
            'description' => 'Power bank 20000mAh con panel solar integrado de alta eficiencia. Resistente al agua IP67, carga rápida para dos dispositivos simultáneamente.',
            'price' => 59.99,
            'image' => 'https://http2.mlstatic.com/D_NQ_NP_815384-MLA107186961252_022026-O.webp',
            'category' => 'Cargadores',
            'eco_feature' => 'Energía renovable',
            'is_active' => true,
            'stock' => 100
        ]);

        Product::create([
            'name' => 'Funda Biodegradable',
            'slug' => 'funda-biodegradable',
            'description' => 'Funda 100% compostable para iPhone. Fabricada con polímeros vegetales, se descompone en 6 meses sin dejar residuos tóxicos.',
            'price' => 29.99,
            'image' => 'https://media2.apokin.es/179284-large_default/funda-silicona-ecologica-biodegradable-iphone-15-6-colores.jpg',
            'category' => 'Accesorios',
            'eco_feature' => 'Compostable',
            'is_active' => true,
            'stock' => 200
        ]);

        Product::create([
            'name' => 'Lámpara LED Ecológica',
            'slug' => 'lampara-led-ecologica',
            'description' => 'Lámpara de escritorio con 80% menos consumo energético. Base de madera reciclada y bombilla LED de 50000 horas de vida útil.',
            'price' => 45.99,
            'image' => 'https://lummina.com.ar/wp-content/uploads/2024/05/D_710940-MLU73467978968_122023-F.jpg',
            'category' => 'Iluminación',
            'eco_feature' => 'Ahorro energético',
            'is_active' => true,
            'stock' => 75
        ]);

        Product::create([
            'name' => 'Teclado Reciclado',
            'slug' => 'teclado-reciclado',
            'description' => 'Teclado mecánico fabricado con plásticos reciclados del océano. Teclas silenciosas, resistente al agua y compatible con todos los sistemas operativos.',
            'price' => 79.99,
            'image' => 'https://m.media-amazon.com/images/S/aplus-media-library-service-media/f75dccc1-8c01-4fdc-836d-fb70b3937d8e.__CR0,0,600,450_PT0_SX600_V1___.jpg',
            'category' => 'Periféricos',
            'eco_feature' => 'Plástico reciclado',
            'is_active' => true,
            'stock' => 30
        ]);

        

        
    }
}
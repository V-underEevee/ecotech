<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                    // Clave primaria (no contar para los 5 campos)
            $table->string('name');          // Campo 1: Nombre del producto
            $table->string('slug')->unique();// Campo 2: URL amigable
            $table->text('description');     // Campo 3: Descripción
            $table->decimal('price', 10, 2); // Campo 4: Precio
            $table->string('image');     // Campo 5: Imagen
            $table->string('category');      // Campo 6: Categoría
            $table->string('eco_feature');   // Campo 7: Característica ecológica
            $table->boolean('is_active')->default(true); // Campo 8: Activo
            $table->integer('stock')->default(0);        // Campo 9: Stock
            $table->timestamps();            // created_at, updated_at (no contar)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
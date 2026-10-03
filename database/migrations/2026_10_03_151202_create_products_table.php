<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Crea una llave primaria BIGINT autoincremental
            
            $table->string('nombre', 100); // VARCHAR(100) para el nombre del platillo
            $table->text('descripcion')->nullable(); // TEXT opcional (ingredientes, porciones)
            
            // DECIMAL(8, 2): Vital en sistemas financieros/ventas. Evita errores de punto flotante.
            $table->decimal('precio', 8, 2); 
            
            $table->string('categoria', 50); // VARCHAR(50) Ej: 'Hamburguesas', 'Snacks', 'Bebidas'
            $table->string('image_path')->nullable(); // Ruta o URL de la foto del platillo
            
            // TINYINT(1) con valor por defecto TRUE (1). Si se agota en cocina, pasa a FALSE (0).
            $table->boolean('disponible')->default(true); 
            
            $table->timestamps(); // Crea automáticamente 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
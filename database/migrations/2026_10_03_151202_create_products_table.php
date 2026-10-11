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
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable(); 
            $table->decimal('precio', 8, 2); 
            $table->string('categoria', 50); 
            $table->string('image_path')->nullable();
            $table->boolean('disponible')->default(true); 
            $table->timestamps(); 
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
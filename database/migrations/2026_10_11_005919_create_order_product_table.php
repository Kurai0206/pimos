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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            //Llaves foraneas
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignID('product_id')->constrained()->onDelete('cascade');

            //Cantidad de platillos en la orden
            $table->integer('cantidad')->default(1);

            //Precio unitario
            $table->decimal('precio_unitario', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            //Relación con el usuario
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('calle', 150);
            $table->string('colonia', 100);
            $table->string('codigo_postal', 10)->nullable();

            $table->text('referencia')->nullable();
            $table->string('telefono_contacto', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Kurai Admin',
            'email' => 'kurai@pimos.com',
        ]);
        // 2. Crear usuarios (clientes)
        User::factory(10)->create();
        
        // 3. Crear el menú de comida
        Product::factory(50)->create();
        
        // 4. Generar direcciones para los usuarios
        Address::factory(15)->create();
        
        // 5. Crear órdenes y vincularlas con platillos (Tabla Pivote)
        // Se crean 30 órdenes. A cada orden se le adjuntan platillos aleatorios.
        Order::factory(30)->create()->each(function ($order) {
            // Obtenemos de 1 a 4 productos al azar
            $productos = Product::inRandomOrder()->take(rand(1, 4))->get();
            
            foreach ($productos as $producto) {
                // Adjuntamos el producto a la orden en la tabla pivote
                $order->products()->attach($producto->id, [
                    'cantidad' => rand(1, 3), // Piden de 1 a 3 piezas de ese platillo
                    'precio_unitario' => $producto->precio // Congelamos el precio
                ]);
            }
        });
    }
}

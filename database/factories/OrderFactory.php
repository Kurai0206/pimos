<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Vincula el pedido a un usuario cliente aleatorio
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            
            // Simula el importe total a pagar del ticket (entre $50.00 y $800.00)
            'total'   => $this->faker->randomFloat(2, 50, 800),
            
            // Simula en qué etapa logística se encuentra la orden actualmente
            'status'  => $this->faker->randomElement(['pendiente', 'preparando', 'entregado', 'cancelado']),
        ];
    }
}

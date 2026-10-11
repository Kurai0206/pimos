<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'      => $this->faker->unique()->words(3, true),
            'descripcion' => $this->faker->sentence(10),
            'precio'      => $this->faker->randomFloat(2, 20, 250),
            'categoria'   => $this->faker->randomElement(['Hamburguesas', 'Boneless', 'Snacks', 'Bebidas', 'Combos']),
            'image_path'  => $this->faker->imageUrl(640, 480, 'food', true),
            'disponible'  => $this->faker->boolean(85), //probabilidad del 855 de devolver true
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => User::inRandomOrder()->first()->id ?? User::factory(),
            'calle'             => $this->faker->streetAddress(),
            'colonia'           => $this->faker->citySuffix(), // Simula nombres de colonias
            'codigo_postal'     => $this->faker->postcode(),
            'referencia'        => $this->faker->sentence(6),
            'telefono_contacto' => $this->faker->numerify('##########'),
        ];
    }
}

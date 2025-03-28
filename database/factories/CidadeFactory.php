<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cidade>
 */
class CidadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cidades = [
            'Cuiabá',
            'Várzea Grande',
            'Rondonópolis'
        ];

        return [
            'cid_nome' => fake()->unique()->randomElement($cidades)
        ];
    }
}

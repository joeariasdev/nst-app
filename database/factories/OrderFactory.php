<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Subsidiary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
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
            'code' => uniqid(time(), true),
            'client_id' => Client::all()->random()->id,
            'subsidiary_id' => Subsidiary::all()->random()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement([Device::HDD, Device::SSD]),
            'serial' => $this->faker->unique()->creditCardNumber(),
            'description' => $this->faker->text(100),
            'client_id' => Client::first(),
        ];
    }
}

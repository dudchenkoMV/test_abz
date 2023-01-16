<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $admin = User::all()->random();

        return [
            'name' => fake()->unique()->jobTitle(),
            'admin_created_id' => $admin->id,
            'admin_updated_id' => $admin->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Facades\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'position_id' => Position::all()->random(),
            'name' => fake()->name(),
            'employment_at' => fake()->date(),
            'phone' => fake('uk_UA')->format('+380 (##) ### ## ##')->phoneNumber(),
            'email' => fake()->safeEmail(),
            'salary' => fake()->randomFloat(0, 1, 500),
            'admin_created_id' => $admin->id,
            'admin_updated_id' => $admin->id,
        ];
    }
}

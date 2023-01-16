<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        $faker = \Faker\Factory::create('uk_UA');

        return [
            'position_id' => Position::all()->random(),
            'name' => fake()->unique()->name(),
            'employment_at' => fake()->date(),
            'phone' => $faker->unique()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'salary' => fake()->randomFloat(0, 100, 500),
            'admin_created_id' => $admin->id,
            'admin_updated_id' => $admin->id,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Users;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $priority = $this->faker->randomElement(['high', 'low', 'medium']);
        return [
            'users_id' => Users::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'priority' => $priority,
            'due_date' => $this->faker->date(),
            
        ];
    }
}

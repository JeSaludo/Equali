<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {       
            return [
                'qualifying_passing_score' => 6,
                'qualified_student_passing_average' => 2.5,
                'qualifying_number_of_items' => 10,
                'qualifying_timer' => 60,
            ];
        
    }
}

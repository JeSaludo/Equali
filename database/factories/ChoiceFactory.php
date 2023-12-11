<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Choice;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Choice>
 */
class ChoiceFactory extends Factory
{
    protected $model = Choice::class;

    public function definition()
    {
        return [
            'choice_text' => $this->faker->word,
            'is_correct' => false, // By default, set is_correct to false
            'question_id' => \App\Models\Question::factory(),
        ];
    }

    // Define a state for creating a "no answer" choice
    public function noAnswer()
    {
        return $this->state(function (array $attributes) {
            return [
                'choice_text' => 'No Answer',
                'is_correct' => false,
            ];
        });
    }

    // Define a state for creating a correct answer
    public function correctAnswer()
    {
        return $this->state(function (array $attributes) {
            return [
                'choice_text' => 'Correct Answer',
                'is_correct' => true,
            ];
        });
    }
}

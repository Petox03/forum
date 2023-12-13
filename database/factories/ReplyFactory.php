<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Va a llenar una pregunta a la que pertenece, un usuario al que pertenece y una respuesta a las respuestas
        return [
            'thread_id' => rand(1,200),
            'user_id' => rand(1,10),
            'body' => fake()->text()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $conversation = Conversation::inRandomOrder()->first();

        $author = null;
        if (rand(0, 1) > 0) {
            $author = $conversation->participant_id;
        } else {
            $author = $conversation->initiator_id;
        }

        $created_at = fake()->unixTime();
        $message = fake()->realText();

        return [
            "conversation_id" => $conversation->id,
            "author_id" => $author,
            "created_at" => $created_at,
            "updated_at" => $created_at,
            "message" => $message,
        ];
    }
}

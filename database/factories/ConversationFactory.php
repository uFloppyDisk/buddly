<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id_first = null;
        $id_last = null;

        while (is_null($id_first) or is_null($id_last)) {
            $id_first = Account::inRandomOrder()->first()->id;
            $id_last = Account::where('id', '!=', $id_first)->inRandomOrder()->first()->id;

            $check = [$id_first, $id_last];

            $result = Conversation::whereIn('initiator_id', $check)->whereIn('participant_id', $check)->first();
            if (!is_null($result)) {
                $id_first = null;
                $id_last = null;
            }
        }
    
        return [
            'initiator_id' => $id_first,
            'participant_id' => $id_last,
        ];
    }
}

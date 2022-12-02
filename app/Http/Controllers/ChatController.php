<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('chat.index', [
            'user' => $user
        ]);
    }

    public function show($conversation_id) {
        $user = Auth::user();
        $conv = Conversation::id($user->id)->where('id', $conversation_id)->first();

        if (is_null($conv)) {
            return redirect()->route('chat')
            ->with('user', $user)
            ->with('status', [
                'type' => 'error',
                'message' => 'Looks like that conversation doesn\'t exist!'
            ]);
        }

        return view('chat.room', [
            'user' => $user,
            'conv' => $conv
        ]);
    }

    public function update(Request $request, $conversation_id) {
        $user = Auth::user();
        $conv = Conversation::id($user->id)->where('id', $conversation_id)->first();

        if (is_null($conv)) {
            return redirect()->route('chat')
            ->with('user', $user)
            ->with('status', [
                'type' => 'error',
                'message' => 'Looks like that conversation doesn\'t exist!'
            ]);
        }

        $message = Message::create([
            'conversation_id' => $conversation_id,
            'author_id' => $request->input('author_id'),
            'message' => $request->input('message')
        ])->id;

        if (is_nan($message)) {
            return redirect()->route('chat.view')
            ->with('user', $user)
            ->with('conv', $conv)
            ->with('status', [
                'type' => 'error',
                'message' => 'Error sending message!'
            ]);
        }

        return back()->withInput();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function postContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);

        Message::create($validated);

        return response()->json([
            'success' => true,
        ]);
    }

    public function getMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();

        $messages->map(function ($message) {
            $message->created = $message->created_at->isoFormat('Do MMM YYYY');
        });

        return response()->json($messages);
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true
        ]);
    }
}

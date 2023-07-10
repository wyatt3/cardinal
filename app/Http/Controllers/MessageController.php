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
        $messages = Message::all();

        return response()->json([
            'messages' => $messages
        ]);
    }

    public function deleteMessage(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:messages,id'
        ]);
        $message = Message::find($request->id);
        $message->delete();

        return response()->json([
            'success' => true
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function postContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'recaptchaResponse' => 'required'
        ]);

        $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . env('RECAPTCHA_SECRET_KEY') . "&response=$request->recaptchaResponse";

        $response = json_decode(Http::post($recaptcha_url)->body());

        if (!$response->success) {
            return response()->json([
                'success' => false,
            ]);
        }

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

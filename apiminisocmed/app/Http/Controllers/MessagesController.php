<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required',
            'message_content' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message_content' => $request->input('message_content'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $message,
        ], 201);
    }

    public function getMessagesByUserId(int $user_id) {
        $messages = Message::where('receiver_id', $user_id)->get();

        if(!$messages) {
            return response()->json([
                'success' => false,
                'message' => 'Messages from this user not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Messages from this user retrieved successfully',
            'data' => $messages,
        ]);
    }

    public function destroy(int $id)
    {
        $message = Message::find($id);
        if(!$message) {
            return response()->json([
                'success' => false,
                'message' => 'Message not found',
            ], 404);
        }
        $message->delete();
        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully',
        ], 200);
    }

    public function show(int $id) {
        $message = Message::find($id);

        if(!$message) {
            return response()->json([
                'success' => false,
                'message' => 'Message not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Message retrieved successfully',
            'data' => $message,
        ]);
    }

    public function index() {
        $messages = Message::get();

        return response()->json([
            'success' => true,
            'message' => 'Message retrieved successfully',
            'data' => $messages,
        ]);
    }

}

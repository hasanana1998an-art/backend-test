<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // عرض كل المحادثات للمستخدم الحالي
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $chats = Chat::where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId)
                    ->orderBy('created_at', 'asc')
                    ->get();
        return response()->json($chats);
    }

    // عرض محادثة معينة
    public function show($chat_id)
    {
        $chat = Chat::find($chat_id);
        if (!$chat) {
            return response()->json(['status' => 'not found'], 404);
        }
        return response()->json($chat);
    }

    // إرسال رسالة
    public function storeMessage(Request $request, $chat_id)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json(['status' => 'success', 'chat' => $chat]);
    }
}

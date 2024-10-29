<?php
// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display the list of users and recent messages for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all users except the currently authenticated user
        $users = User::where('id', '!=', Auth::id())->get();

        // Fetch recent messages for the authenticated user
        $messages = Message::where(function($query) {
                                $query->where('sender_id', Auth::id())
                                      ->orWhere('receiver_id', Auth::id());
                            })
                            ->orderBy('created_at', 'desc')
                            ->take(50)
                            ->get();

        return view('chat.index', compact('users', 'messages'));
    }

    /**
     * Store a new message and broadcast it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        // Create a new message
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        // Broadcast the message
        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }
}

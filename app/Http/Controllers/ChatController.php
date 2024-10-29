<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    // Display the Dashboard View
    public function index()
    {
        return view('manager.dashboard');
    }

    // Display the Chat Interface
    public function chat()
    {
        return view('chat.index');
    }
}

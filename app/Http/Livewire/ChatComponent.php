<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Events\MessageSent;

class ChatComponent extends Component
{
    public $newMessage;
    public $recipientId;
    public $user;
    public $selectedUser;
    protected $listeners = ['sendMessage' => 'sendMessage'];

    public function broadcastMessage($message)
    {
        $recipientUser = User::find($this->recipientId); // Assuming recipientId is set elsewhere
        if (!$recipientUser) {
            \Log::error('Recipient user not found.');
            return;
        }

        $messageModel = new Message();
        $messageModel->sender_id = $this->user->id;
        $messageModel->recipient_id = $recipientUser->id;
        $messageModel->content = $message;
        $messageModel->save();

        broadcast(new MessageSent($messageModel))->toOthers();
    }

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        $messages = $this->selectedUser ? Message::where('sender_id', $this->user->id)
            ->where('recipient_id', $this->selectedUser->id)
            ->orWhere('sender_id', $this->selectedUser->id)
            ->where('recipient_id', $this->user->id)
            ->orderBy('created_at')
            ->get() : [];

        return view('livewire.chat-component', [
            'users' => $users,
            'recipientId' => $this->recipientId,
            'messages' => $messages,
        ]);
    }

    public function selectRecipient($recipientId)
    {
        $this->recipientId = $recipientId;
        $this->selectedUser = User::find($recipientId);
    }

    public function sendMessage()
    {
        try {
            $validatedData = $this->validate([
                'recipientId' => 'required|exists:users,id',
                'newMessage' => 'required|string|max:255',
            ]);
    
            $recipientUser = User::find($validatedData['recipientId']);
    
            if ($recipientUser && $this->user) {
                $this->broadcastMessage($validatedData['newMessage']);
    
                $this->newMessage = '';
    
                \Log::info('Message sent successfully.');
            } else {
                \Log::error('Invalid sender or recipient.');
            }
    
            // Log the emitted event
            \Log::info('sendMessage event emitted.');
            $this->emit('messageSent', $validatedData['newMessage']); // Emit the message
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            \Log::error('Validation Errors: ' . json_encode($errors));
        } catch (\Exception $ex) {
            \Log::error('Exception: ' . $ex->getMessage());
        }
    }
    
}

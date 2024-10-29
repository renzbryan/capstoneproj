<div>
    <div style="display: flex; height: 100vh;">
        <!-- Sidebar with User List -->
        <div style="flex: 1; padding: 20px; background-color: #f4f4f4;">
            <h3 style="margin-bottom: 20px;">User List</h3>
            <ul style="list-style: none; padding: 0;">
                <!-- Iterate over users and display them -->
                @foreach ($users as $user)
                    <li style="margin-bottom: 10px; cursor: pointer; padding: 10px; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" wire:click="selectRecipient({{ $user->id }})">
                        {{ $user->name }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Main Chat Area -->
        <div style="flex: 2; padding: 20px; background-color: #e9ebee;">
            <!-- Chat Header -->
            <div style="background-color: #fff; padding: 15px; border-bottom: 1px solid #ddd;">
                @if ($selectedUser)
                    <h3 style="margin: 0;">Chat with {{ $selectedUser->name }}</h3>
                @else
                    <h3 style="margin: 0;">Select a recipient to start chatting</h3>
                @endif
            </div>

            <!-- Chat Messages -->
            <div id="chat-messages" style="height: 400px; overflow-y: scroll; padding: 15px; background-color: #fff; margin-top: 20px; border-radius: 5px;">
                @if ($selectedUser)
                    <!-- Display chat messages here -->
                    <ul id="message-list" style="list-style: none; padding: 0;">
                        @foreach ($messages as $message)
                            <li style="margin-bottom: 10px;">
                                <div style="max-width: 70%; margin-left: {{ $message->sender_id == Auth::id() ? 'auto' : '0' }}; background-color: {{ $message->sender_id == Auth::id() ? '#dcf8c6' : '#ebeded' }}; padding: 10px; border-radius: 5px;">
                                    <strong>{{ $message->sender_id == Auth::id() ? 'You' : $message->sender->name }}:</strong> {{ $message->content }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Message Input (Disabled until recipient is selected) -->
            @if ($selectedUser)
            <div style="margin-top: 20px;">
                <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage" placeholder="Type a message..." style="width: calc(100% - 70px); padding: 10px; border: 1px solid #ddd; border-radius: 5px 0 0 5px;">
                <button wire:click.prevent="sendMessage" style="padding: 10px; background-color: #0084ff; color: #fff; border: none; border-radius: 0 5px 5px 0; cursor: pointer;"><i class="fa fa-paper-plane"></i>Send</button>
            </div>
            @else
                <div style="margin-top: 20px; color: #777; font-style: italic;">
                    Please select a recipient to start chatting.
                </div>
            @endif
        </div>
    </div>
</div>
@script
<script>
    document.addEventListener("livewire:DOMContentLoaded", function(event) {
        Livewire.on('messageSent', function (message) {
            console.log('Message sent:', message);
            // Adjust this selector based on your HTML structure
            let chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                let messageList = chatMessages.querySelector('ul');
                let newMessage = document.createElement('li');
                newMessage.textContent = message;
                messageList.appendChild(newMessage);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            } else {
                console.error("Chat messages container not found.");
            }
        });

        const pusher = new Pusher('{{ env('b992893b55d3e73033e6') }}', {
            cluster: '{{ env('ap1') }}',
            encrypted: true
        });

        const channel = pusher.subscribe('chat');

        // Receive messages
        console.log('Script executed');

        // Receive messages
        channel.bind('messageSent', function (data) {
            console.log('Received message:', data.message);

            // Broadcast messages
            $("form").submit(function (event) {
                event.preventDefault();
                console.log('Form submitted'); // Log to check if form submission event is triggered
                // Emit 'sendMessage' event with message value
                Livewire.emit('sendMessage', $("form #message").val());
                $("form #message").val('');
                $(document).scrollTop($(document).height());
            });

            // Emit messageSent event
            Livewire.emit('messageSent', data.message);
        });

        // Broadcast messages
        $("form").submit(function (event) {
            console.log('hello');
            event.preventDefault();
            // Emit 'sendMessage' event with message value
            Livewire.emit('sendMessage', $("form #message").val());
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>
@endscript

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->user()->id }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=Nunito">
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JavaScript (includes Popper.js) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        #app {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            height: 80%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            background-color: white;
        }
        .list-group {
            width: 30%;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            height: 100%;
            background-color: #fff;
        }
        .list-group-item {
            display: flex;
            align-items: center;
            padding: 15px;
            cursor: pointer;
            transition: background 0.2s;
            border-bottom: 1px solid #ddd;
        }
        .list-group-item img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .list-group-item:hover, .list-group-item.active {
            background-color: #f0f2f5;
        }
        .list-group-item a {
            text-decoration: none;
            color: #333;
            display: block;
        }
        #chat-window {
            width: 70%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }
        #message-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 12px;
            max-width: 70%;
            word-wrap: break-word;
        }
        .message.sent {
            background-color: #0084ff;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }
        .message.received {
            background-color: #f0f2f5;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }
        .message strong {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        #message-form {
            display: flex;
            align-items: center;
            padding: 10px;
        }
        #message-form .form-group {
            flex: 1;
            margin-right: 10px;
        }
        #message-content {
            width: 100%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 10px 20px;
            resize: none;
            font-size: 14px;
        }
        #message-form .btn {
            padding: 10px 20px;
            background-color: #0084ff;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.2s;
        }
        #message-form .btn:hover {
            background-color: #0056b3;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="list-group">
                @foreach($users as $user)
                    <div class="list-group-item user" data-id="{{ $user->id }}">
                        <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}">
                        <a href="#">{{ $user->name }}</a>
                    </div>
                @endforeach
            </div>
            <div id="chat-window">
                <div id="message-container">
                    @foreach($messages as $message)
                        <div class="message {{ $message->sender->id === auth()->user()->id ? 'sent' : 'received' }}">
                            <strong>{{ $message->sender->name }}:</strong> {{ $message->content }}
                        </div>
                    @endforeach
                </div>
                <form id="message-form">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="receiver_id" id="receiver-id">
                        <textarea name="content" id="message-content" class="form-control" placeholder="Type your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let receiverId = null;

        document.querySelectorAll('.user').forEach(user => {
            user.addEventListener('click', function (e) {
                e.preventDefault();
                receiverId = this.getAttribute('data-id');
                document.getElementById('receiver-id').value = receiverId;

                // Mark the active user
                document.querySelectorAll('.list-group-item').forEach(item => item.classList.remove('active'));
                this.classList.add('active');

                // Subscribe to the private channel for the selected user
                window.Echo.private(`chat.${receiverId}`)
                    .listen('MessageSent', (e) => {
                        console.log('New message received: ', e.message);
                        displayMessage(e.message);
                    });
            });
        });

        document.getElementById('message-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const content = document.getElementById('message-content').value;

            fetch('/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    receiver_id: receiverId,
                    content: content
                })
            }).then(response => response.json())
              .then(data => {
                  console.log('Message sent: ', data);
                  displayMessage(data);
                  document.getElementById('message-content').value = '';
              }).catch(error => console.error('Error:', error));
        });

        function displayMessage(message) {
            const messageContainer = document.getElementById('message-container');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', message.sender.id === {{ auth()->user()->id }} ? 'sent' : 'received');
            messageElement.innerHTML = `
                <strong>${message.sender.name}:</strong> ${message.content}
            `;
            messageContainer.appendChild(messageElement);
        }
    });
</script>

</body>
</html>

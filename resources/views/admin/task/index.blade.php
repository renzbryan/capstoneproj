<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Task Management</h1>

        <div class="row">
            <!-- User Cards -->
            @foreach($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">Email: {{ $user->email }}</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignTaskModal" data-user-id="{{ $user->id }}">
                                Assign Task
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2 class="mt-4">Task List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->assignedUser->name }}</td>
                        <td>
                            @if ($task->status == 'viewed')
                                <span class="badge badge-primary">Viewed</span>
                            @elseif ($task->status == 'done')
                                <span class="badge badge-success">Done</span>
                            @else
                                <span class="badge badge-secondary">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        
        
        @include('admin.task.assigntask')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $('#assignTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('user-id');
            var workerName = button.closest('.card').find('.card-title').text();
            var modal = $(this);
            modal.find('.modal-title #workerName').text(workerName);
            modal.find('form').attr('action', '/tasks/' + userId + '/assign');
        });
    </script>
</body>
</html>

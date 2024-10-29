<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- External Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <!-- Embedded CSS Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        nav {
            background-color: #29487d;
            padding: 15px;
            margin-bottom: 20px;
            height: 100px;
            display: flex;
            justify-content: space-between; /* Adjusted alignment */
            align-items: center; /* Adjusted alignment */
        }
        nav a {
            color: #ffffff;
            margin: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }
        nav a:hover {
            color: #0056b3;
            text-decoration: none;
        }
        .container{
            margin-top:25px; /* Adjusted margin */
        }
        /* Updated card styles */
        .card {
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.025);
        }
        .card-header {
            background-color: #343a40;
            color: #ffffff;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        /* Updated button styles */
        .btn {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #3a5998;
            border-color: #3a5998;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .pagination-container .pagination {
        margin: 0;
        padding: 0;
    }

    .pagination-container .pagination > li {
        margin: 0 5px;
        list-style-type: none;
    }

    .pagination-container .pagination > li > a,
    .pagination-container .pagination > li > span {
        color: #007bff;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #007bff;
        border-radius: 4px;
    }

    .pagination-container .pagination > .page-item.active > a,
    .pagination-container .pagination > .page-item.active > span {
        background-color: #007bff;
        color: #fff;
    }

    .pagination-container .pagination > .page-item.disabled > span,
    .pagination-container .pagination > .page-item.disabled > a {
        color: #6c757d;
        pointer-events: none;
        cursor: not-allowed;
    }   
    </style>
</head>
<body>

    <nav>
        <h1 style="color: #ffffff; margin-left: 25px;">My Tasks</h1> <!-- Moved "My Tasks" to nav -->
    </nav>
    
    <div class="container">
        <div class="table-responsive">
            @foreach($tasks as $task)
            <div class="card">
                <div class="card-header">
                    Task Name: {{ $task->title }}
                </div>
                <div class="card-body">
                    <p class="card-text">Description: {{ $task->description }}</p>
                    <p class="card-text">Priority: {{ $task->priority }}</p>
    
                    <div class="action-column">
                        <a class="btn btn-success" href="{{ route('tasks.do', ['task' => $task->id, 'type' => $task->title]) }}">Do Task</a>
                    </div>
                    @if($task->priority === 'High')
                    <div class="alert alert-danger" role="alert">
                        This task requires immediate attention. It should be completed within 1 day.
                    </div>
                    @elseif($task->priority === 'Medium')
                    <div class="alert alert-warning" role="alert">
                        This task is of medium priority. It should be completed within 1-3 days.
                    </div>
                    @elseif($task->priority === 'Low')
                    <div class="alert alert-info" role="alert">
                        This task is of low priority. It should be completed within 1-5 days.
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-container d-flex justify-content-center mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
    
    
    <!-- External JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

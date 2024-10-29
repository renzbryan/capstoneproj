<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Management System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    nav.vertical-nav {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 15%;
        background-color: #03396c;
        height: 100%; 
        position: fixed; 
        overflow: auto; 
    }

    nav.vertical-nav img {
        display: block;
        width: 100%; 
        margin: 0 auto; 
        padding: 8px 16px;
    }

    nav.vertical-nav a {
        display: block;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
    }

    nav.vertical-nav a:hover {
        background-color: #011f4b;
        color: white;
        text-decoration: none;
    }

    .container img{
        display: block;
        width: 11%; 
        margin: 0 auto; 
    }

    nav.horizontal-nav {
        background-color: white;
        color: black;
        margin-left:15%;
        padding: 16px;
        position: fixed;
        width: 85%;
        top: 0;
    }

    nav.horizontal-nav a {
        color: black;
        text-decoration: none;
        float: right;
        margin-left: 20px; /* Adjust as needed */
    }

    nav.horizontal-nav a:hover {
        color: white;
        text-decoration: none;
        background: gray;
    }
    
    .container img{
        display: block;
        width: 113%; 
        height: 75%;
        margin: 0 auto; 
    }

    .row {
      margin-left:25%;
      padding:1px 16px;
      height:1000px; 
    }

    .dropdown {
        position: relative;
        display: inline-block;
        display: block;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
    }
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 999; /* Ensure the dropdown appears above other elements */
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        color: black; /* Set the color of dropdown options */
        text-decoration: none;
    }

    .dropdown-content a:hover {
        background-color: #ddd; /* Change background color on hover */
    }


  </style>
</head>
<body>

<!-- Vertical Navbar -->
<nav class="vertical-nav">

<img src="{{ asset('images/logo.png') }}" alt="Logo">

  <a href="#">Dashboard</a>
  <a href="{{ route('tasks.index') }}">My Task</a>

  <div class="dropdown">
  <span>Forms</span>
  <div class="dropdown-content">
  <a class="dropdown-item" href="{{ route('iar.index') }}">IAR Form</a>
  <a class="dropdown-item" href="#">Stock Card</a>
  <a class="dropdown-item" href="#">Property Card</a>
  <a class="dropdown-item" href="#">WMR Form</a>
  <a class="dropdown-item" href="#">RIS Form</a>
  <a class="dropdown-item" href="#">RPCI Form</a>
  <a class="dropdown-item" href="#">RAAF Form</a>
  <a class="dropdown-item" href="#">ICS Form</a>
  <a class="dropdown-item" href="#">RSMI Form</a>
  <a class="dropdown-item" href="#">SPC Form</a>
  <a class="dropdown-item" href="#">RSPI Form</a>
  <a class="dropdown-item" href="#">RegSPI Form</a>
  <a class="dropdown-item" href="#">ITR Form</a>
  <a class="dropdown-item" href="#">IIRUP/Semi Form</a>
  <a class="dropdown-item" href="#">PAR Form</a>
  <a class="dropdown-item" href="#">RPCPPE Form</a>
  <a class="dropdown-item" href="#">PTR Form</a>
  <a class="dropdown-item" href="#">IIRUP/PPE Form</a>
  <a class="dropdown-item" href="#">RLSDDSP Form</a>
  <a class="dropdown-item" href="#">Returned/PPE Form</a>

  </div>
</div>
  <a href="{{ route('archive.iar') }}">Archived Forms</a>
  <a href="#">Inventory</a>
  <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Notifications <span class="badge badge-pill badge-primary">{{ auth()->user()->unreadNotifications()->count() }}</span>
        </button>
        <div class="dropdown-menu">
        @foreach(auth()->user()->unreadNotifications as $notification)
        <a class="dropdown-item" href="{{ $notification->data['url'] }}">{{ $notification->data['message'] }}</a>
        @endforeach
        </div>
</div>
  
</nav>

<nav class="horizontal-nav">
  <a href="{{ route('profile.edit') }}">Profile</a>
  <a href="{{ route('logout') }}">Logout</a>
</nav>

  <!-- Main Content -->
  <div class="container">
  <img src="{{ asset('images/1.jpg') }}" alt="background">
    <div class="row">
      <div class="col-md-6">
        <h2>Welcome to the BFAR Property Unit Management System, {{ $user->name }}</h2>
        <p>This system helps you organize and manage your documents efficiently.</p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

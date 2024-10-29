<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BFAR')</title>

    <!-- Include Bootstrap CSS (you can use a CDN or local file) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
        }

        .card {
            border: 1px solid #28a745; /* Green border for the cards */
        }

        .btn-success {
            background-color: #28a745; /* Green button background color */
            border-color: #28a745; /* Green button border color */
        }

        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
            border-color: #218838;
        }

        .navbar {
            background-color: #28a745; /* Green navigation bar background color */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ffffff; /* White navigation links color */
        }

        .navbar-light .navbar-toggler-icon {
            background-color: #ffffff; /* White color for the navbar toggler icon */
        }

        footer {
            background-color: #28a745; /* Green footer background color */
            color: #ffffff; /* White footer text color */
            padding: 10px 0; /* Add some padding to the footer */
        }
    </style>
</head>
<body>

    <header>
        <!-- Navigation bar or menu -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Your navigation links -->
        </nav>
    </header>

    <main>
        <form action="/upload" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit">Upload</button>
        </form>
    </main>

    <footer class="mt-5 text-center">
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} BFAR. All rights reserved.</p>
    </footer>

    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
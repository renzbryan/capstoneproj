<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BFAR')</title>

    <!-- Include Bootstrap CSS (you can use a CDN or local file) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <header>
        <!-- Navigation bar or menu -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Your navigation links -->
        </nav>
    </header>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('update.excel') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="updated_value">OIC, Property & Supply Officer:</label>
                    <input type="text" name="updated_value" class="form-control" style="text-transform: uppercase;">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>

    <footer class="mt-5 text-center">
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} BFAR. All rights reserved.</p>
    </footer>

    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
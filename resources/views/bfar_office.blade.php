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
            <h2>Create Bfar Office</h2>
    
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <form method="post" action="{{ route('bfar_office.store') }}">
                @csrf
    
                <div class="mb-3">
                    <label for="office" class="form-label">Office:</label>
                    <input type="text" class="form-control" id="office" name="office" required>
                </div>
    
                <div class="mb-3">
                    <label for="rcc" class="form-label">RCC:</label>
                    <input type="text" class="form-control" id="rcc" name="rcc" required>
                </div>
    
                {{-- Add more input fields for other columns as needed --}}
                
                <button type="submit" class="btn btn-primary">Submit</button>
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
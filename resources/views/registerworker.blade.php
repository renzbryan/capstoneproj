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
        <div class="container mt-5" style="max-width: 600px;"> <!-- Adjust the max-width as needed -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #28a745; color: #ffffff;">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">{{ __('Register') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

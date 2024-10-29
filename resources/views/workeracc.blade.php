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
            border: 1px solid #007bff; /* Blue border for the cards */
        }

        .btn-primary {
            background-color: #007bff; /* Blue button background color */
            border-color: #007bff; /* Blue button border color */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3;
        }

        .navbar {
            background-color: #007bff; /* Blue navigation bar background color */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ffffff; /* White navigation links color */
        }

        .navbar-light .navbar-toggler-icon {
            background-color: #ffffff; /* White color for the navbar toggler icon */
        }

        footer {
            background-color: #007bff; /* Blue footer background color */
            color: #ffffff; /* White footer text color */
            padding: 10px 0; /* Add some padding to the footer */
        }
    </style>
</head>
<body>

    <header>

    </header>

    <main>
        <div class="container mt-5" style="max-width: 600px;"> <!-- Adjust the max-width as needed -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #007bff; color: #ffffff;">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
    
                                    <div class="mb-3 form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
    
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
    
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
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

<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Document Management System')</title>
  <!-- Add Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Add custom styles here if needed -->
  @stack('styles')
</head>
<body class="bg-gray-100">

  <!-- Include Navigation -->
  @include('layouts.navigation')

  <!-- Main Content -->
  <div class="container mx-auto py-10">
    @yield('content')
  </div>

  @stack('scripts')
</body>
</html>

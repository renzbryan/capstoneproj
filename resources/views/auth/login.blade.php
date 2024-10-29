<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* Custom background image styling */
        body {
            background-image: url('/images/1.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-100 bg-opacity-75">
    <div class="w-full max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <?php if (session('status')): ?>
            <div class="mb-4 text-green-600">
                <?= session('status') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= route('login') ?>">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="<?= csrf_token() ?>">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required autofocus autocomplete="username" value="<?= old('email') ?>">
                <?php if ($errors->has('email')): ?>
                    <p class="text-red-500 text-xs mt-2"><?= implode(', ', $errors->get('email')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required autocomplete="current-password">
                <?php if ($errors->has('password')): ?>
                    <p class="text-red-500 text-xs mt-2"><?= implode(', ', $errors->get('password')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Remember Me -->
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Forgot Password and Login Button -->
            <div class="flex items-center justify-end">
                <?php if (Route::has('password.request')): ?>
                    <a href="<?= route('password.request') ?>" class="underline text-sm text-gray-600 hover:text-gray-900">Forgot your password?</a>
                <?php endif; ?>

                <button type="submit" class="ml-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Log in
                </button>
            </div>
        </form>
    </div>
</body>
</html>

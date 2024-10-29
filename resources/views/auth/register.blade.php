<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
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
<body class="bg-gray-100">
    <div class="w-full max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <form method="POST" action="<?= route('register') ?>">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="<?= csrf_token() ?>">

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input id="name" type="text" name="name" class="w-full p-2 border border-gray-300 rounded" value="<?= old('name') ?>" required autofocus autocomplete="name">
                <?php if ($errors->has('name')): ?>
                    <p class="text-red-500 text-xs mt-2"><?= implode(', ', $errors->get('name')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" class="w-full p-2 border border-gray-300 rounded" value="<?= old('email') ?>" required autocomplete="username">
                <?php if ($errors->has('email')): ?>
                    <p class="text-red-500 text-xs mt-2"><?= implode(', ', $errors->get('email')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required autocomplete="new-password">
                <?php if ($errors->has('password')): ?>
                    <p class="text-red-500 text-xs mt-2"><?= implode(', ', $errors->get('password')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required autocomplete="new-password">
                <?php if ($errors->has('password_confirmation')): ?>
                    <p class="text-red-500 text-xs mt-2"><?= implode(', ', $errors->get('password_confirmation')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Already Registered Link and Register Button -->
            <div class="flex items-center justify-end mt-4">
                <a href="<?= route('login') ?>" class="underline text-sm text-gray-600 hover:text-gray-900">Already registered?</a>
                <button type="submit" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>

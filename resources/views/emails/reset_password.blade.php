<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password | {{ $settings['site_name'] }}</title>
    <style>
    </style>
</head>
<body>
<div class="email-container">
    <header>
        <img src="{{ asset($settings['logo']) }}" alt="Logo" style="float: right;">
    </header>
    <main>
        <h1>Reset Your Password</h1>
        <p>Click the link below to reset your password:</p>
        <a href="{{ $resetLink }}">Reset Password</a>
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} {{ $settings['name'] }}. All rights reserved.</p>
    </footer>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>رسالة جديدة | {{ $settings['site_name'] ?? 'مؤسسة الغويري' }}</title>
<head>
    <style>
    </style>
</head>
<body>
<div class="email-container">
    <header>
        <img src="{{ url($settings['logo']) }}" alt="Logo" style="float: right;">
        {{-- <img src="{{ asset('themes/gf-mnh/frontend_images/logo.png') }}" alt="Logo" style="float: right;"> --}}
    </header>
    <main>
        
<h2>رسالة جديدة من نموذج اتصل بنا</h2>
<p><strong>الاسم:</strong><br> {{ $name }}</p>
<p><strong>البريد:</strong><br> {{ $email }}</p>
<p><strong>الموضوع:</strong><br> {{ $subject }}</p>
<p><strong>الرسالة:</strong><br>{{ $user_message }}</p>
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} {{ $settings['name'] }}. All rights reserved.</p>
    </footer>
</div>
</body>
</html>

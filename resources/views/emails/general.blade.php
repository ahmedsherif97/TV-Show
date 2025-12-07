<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }} | {{ $settings['site_name'] }}</title>
    <style>
    </style>
</head>
<body>
<div class="email-container">
    <header>
        <img src="{{ asset($settings['logo']) }}" alt="Logo" style="float: right;">
    </header>
    <main>
        <h1>{{ $title }}</h1>
        <p>{{ $message }}</p>
        @if(isset($data))
            <ul>
                @foreach($data as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @endif
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} {{ $settings['site_name'] }}. All rights reserved.</p>
    </footer>
</div>
</body>
</html>

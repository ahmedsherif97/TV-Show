<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
            outline: 0;
        }
    </style>
</head>

<body>
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        @auth
        Tawk_API.visitor = {
            name: "{{ auth()->user()->name }}",
            email: "{{ auth()->user()->email }}",
            // phone: "{{ auth()->user()->phone ?: auth()->user()->username }}",
        };
        @endauth
        window.Tawk_API.customStyle = {
            width: '100%',
            height: '100%',
        };
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/681a0d3cf496ef1910ac002f/1iqis7esn';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
        window.Tawk_API.onLoad = function() {
            console.log('onLoad');
            window.Tawk_API.maximize();
            document.getElementsByTagName('iframe')[0].remove();
            var iframe = document.getElementsByTagName('iframe')[0];
            iframe.id = 'iframe-container';
            iframe.removeAttribute('style');
            iframe.style.position = 'fixed';
            iframe.style.top = '0';
            iframe.style.left = '0';
            iframe.style.outline = '0';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
        };
    </script>
</body>

</html>

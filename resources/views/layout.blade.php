<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body style="margin-top: 40px;">

<div class="text-center">
    <img src="https://i.imgur.com/hHZjfUq.png"><br>
    <span class="text-secondary">Laravel Skrill Payment Gateway Integration with LaraSkrill</span>
</div>

<div class="container" style="margin-top: 40px;">
    @yield('content')
</div>

</body>
</html>

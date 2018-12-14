<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>qr</title>

</head>
<body>
{!! QrCode::size(200)->generate('hello world'); !!}
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('token'))
        <p>Token dari session: <code>{{ session('token') }}</code></p>
        <script>
            console.log('Token dari session:', '{{ session('token') }}');
        </script>
    @else
        <p>Tidak ada token di session.</p>
    @endif
</body>

</html>

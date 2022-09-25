<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Announcement App</title>
    <meta name="description" content="Laravel Announcement App">
    <meta name="author" content="Jane Hernandez">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @inertia

    @routes
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ config('app.name') }}</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-slate-950 text-gray-100">

@yield('content')

</body>

</html>


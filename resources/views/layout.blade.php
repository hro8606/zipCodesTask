<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Project Test')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<div class="nav">
    <nav>
        <ul>
            <li ><a href="/">Home</a></li>
            <li><a href="/add">Add</a></li>
        </ul>
    </nav>
</div>


@yield('content')

</body>

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

@yield('javascript')

</html>
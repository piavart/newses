<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Новости</title>
</head>
<body>
<div id="app">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-5 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Новости</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{route('index')}}">Главная</a>
            <a class="p-2 text-dark" href="{{route('create')}}">Новая запись</a>
        </nav>
        {{--<a class="btn btn-outline-primary" href="#">Sign up</a>--}}
    </div>
    <div class="container">

        </nav>
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
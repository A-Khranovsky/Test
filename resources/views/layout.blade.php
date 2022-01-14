<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
?>
    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<div class="container">
    <div class="row">
        <div class="container">
            <div class="row bg-success rounded bg-gradient d-flex align-items-center p-2">
                <div class="col"> <a class="navbar-brand" href="/">ToDo-List</a></div>
                @auth
                    <div class="col">Wellcome {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                    <div class="col">@include('logout')</div>
                @endauth
                @guest
                    <div class="col">@include('login')</div>
                @endguest
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>

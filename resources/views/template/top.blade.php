<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astronacci @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap5/bootstrap.min.css') }}">
    
    <script src="{{ asset('plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap5/bootstrap.bundle.min.js') }}"></script>
</head>
<body><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astronacci @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap5/bootstrap.min.css') }}">
    
    <script src="{{ asset('plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap5/bootstrap.bundle.min.js') }}"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg  bg-primary bg-body-dark"> 
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Astronacci</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Beranda</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <form class="d-flex" role="search"> 
            <a class="btn btn-outline-success" href="{{ url('logout') }}">Logout</a>
        </form>
        </div>
    </div>
</nav> 
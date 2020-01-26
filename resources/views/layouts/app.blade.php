<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
@include('_partials.sidebar')
<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
        @include('_partials.topbar')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('headline')
                <!-- Content Row -->
                <div class="row p-3">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Scripts -->
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	
    
    <!-- Stylesheets -->

    <link href="/assets/frontend/css/bootstrap.css" rel="stylesheet">

    <link href="/assets/frontend/css/swiper.css" rel="stylesheet">

    <link href="/assets/frontend/css/ionicons.css" rel="stylesheet">



    
    @stack('css')
    

    <!-- Fonts -->


    <!-- Styles -->


</head>
<body>

@include('layouts.frontend.partial.header');

@yield('content')



    @include('layouts.frontend.partial.footer');




	<!-- SCIPTS -->

    <script src="/assets/frontend/js/jquery-3.1.1.min.js"></script>

    <script src="/assets/frontend/js/tether.min.js"></script>

    <script src="/assets/frontend/js/bootstrap.js"></script>



    @stack('js')


</body>
</html>

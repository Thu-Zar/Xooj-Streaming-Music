

<html>
<head>
    <title>Welcome to Xooj!</title>

    <link rel="stylesheet" type="text/css" href="{{asset('vendor/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
    <script type="text/javascript" src="{{asset('vendor/js/script.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body style="overflow-x: hidden;">
    
    <div id="mainContainer">

        <!-- Navigation -->
        @include('part.navBar')

        <!-- Page Content -->
        @yield('content')
        <!-- /.container -->
        
        <!-- playing bar -->
        @include('part.playingBar')
        
    </div>

</body>


</html>
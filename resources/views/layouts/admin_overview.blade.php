<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>PAULANO GRACELAND | {{$title}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Outfit:400,500,700&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.orgchart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/settings.css')}}" media="screen" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery.themepunch.plugins.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.themepunch.revolution.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>    



</head>

<body>
    <div class="wrapper">
        <div class="content">
            @include('subviews.admin_menu')
            <div class="main-container">
                @include('subviews.admin_header')
                @yield("user_content")
            </div>
        </div>
    </div>    
</div>

</body>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $(".wrapper .content").toggleClass("toggled");
        $(this).toggleClass("toggled");
    });
    $("#close-menu").click(function(e) {
        e.preventDefault();
        $(".wrapper .content").toggleClass("toggled");
        $(this).toggleClass("toggled");
    });

    $("#menu-toggle-xs").click(function(e) {
        e.preventDefault();
        $(".wrapper .content").toggleClass("toggled");
        $(this).toggleClass("toggled");
    });
</script>

</html>

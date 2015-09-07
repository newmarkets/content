<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="@yield('meta-title')">
    <meta name="keywords" content="@yield('meta-keywords')">
    <meta name="decription" content="@yield('meta-description')">
    <title>@yield('title')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <style>
        body > .container {
            padding: 60px 15px 0;
        }
        .footer > .container {
            padding-right: 15px;
            padding-left: 15px;
        }
        .container .text-muted {
            margin: 20px 0;
        }
        /* Sticky footer styles -------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #f5f5f5;
        }
    </style>
    @yield('style')
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                @if (Auth::check())
                    <li><a href="/{{ Config::get('content.category_base') }}">CMS {{ Lang::choice('content::messages.category', 2) }}</a></li>
                    <li><a href="{{ URL::to('auth/logout') }}">Log out</a></li>
                @else
                    <li><a href="{{ URL::to('auth/login') }}">Log in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="footer">
    <div class="container">
        <p class="small text-muted pull-right">powered by <a href="http://newmarket.solutions">NewMarket Solutions CMS</a></p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
@yield('script')

</body>
</html>

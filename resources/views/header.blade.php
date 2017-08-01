<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<title>Diverse Americans</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ url('/img/favicon.png') }}">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Custom styles -->
<link rel="stylesheet" href="{{ url('/css/style.css') }}" type="text/css" media="screen">
<!-- Fonts -->
<script src="https://use.fontawesome.com/edb8f2d332.js"></script>
<link href="https://fonts.googleapis.com/css?family=Arimo:400" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
    main .sidebar > div > a {
        color: #0177c1;
        display: block;
        text-align: left;
        font-size: 16px;
        font-weight: bold;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }
    main .sidebar h2 {
        background: #0177c1;
        color: white;
        font-size: 18px;
        padding: 15px;
        margin: 0 0 30px 0;
        text-align: center;
    }
    main .sidebar > div > a > span {
        color: #dc1414;
        float: none;
    }
    header .jumbotron .input-group > input {
        height: auto;
        font-size: 26px;
        padding: 12px;
    }
    main .search .form-group input {
        height:auto;
        padding:10px;
    }
    main form.login .login-signup .btn.btn-login {
        margin-right:9px;
    }
</style>
</head>
<body>
<div class="container-fluid">
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapsible" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="{{ url('/img/logo.png') }}" /></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapsible">
                    <ul class="nav navbar-nav navbar-right">
                        <li {!! Route::current()->uri() == '/' ? 'class="active"' : '' !!}><a href="/">Home</a></li>
                        <li {!! Route::current()->uri() == 'advanced-search' ? 'class="active"' : '' !!}><a href="/advanced-search">Advanced Search</a></li>
                        <li {!! Route::current()->uri() == 'login' ? 'class="active"' : '' !!}><a href="/login">Log In</a></li>
                        <li {!! Route::current()->uri() == 'contact' ? 'class="active"' : '' !!}><a href="/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron" {!! Route::current()->uri() != '/' ? 'style="height:80px;"' : '' !!}>
            <div class="background"><img src="{{ url('/img/banner.jpg') }}" /></div>
            <div class="container" {!! Route::current()->uri() != '/' ? 'style="display:none;"' : '' !!}>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form action="/advanced-search" method="get">
                            <div class="input-group" {!! Route::current()->uri() != '/'? 'style="margin-top:15px;"' : '' !!}>
                                <input type="text" name="search" class="form-control" placeholder="Search..." aria-describedby="search">
                                <span style="cursor:pointer;" onclick="jQuery(this).closest('form').submit()" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

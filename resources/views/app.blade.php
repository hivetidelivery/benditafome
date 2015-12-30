<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BenditaFome</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-panel {
            background: #337AB7;
            color: #fff;
            position: absolute;
            right: 119px;
            top: 74px;
            border-color: #fff;
        }

        .btn-panel:hover {
            background: none;
            color: #fff;
            border-color: #fff
        }
    </style>

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">BenditaFome</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                @if(Auth::user())
                    @if(Auth::user()->role == 'admin')
                        <li><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
                        <li><a href="{{ route('admin.products.index') }}">Produtos</a></li>
                        <li><a href="{{ route('admin.clients.index') }}">Clientes</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}">Copuns</a></li>
                        <li><a href="{{ route('admin.orders.index') }}">Pedidos</a></li>
                    @elseif(Auth::user()->role == 'client')
                        <li><a href="{{ route('costumer.order.index') }}">Meus pedidos</a></li>
                    @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->guest())
                    @if(!Request::is('/login'))
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    @endif
                    @if(!Request::is('/register'))
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

@yield('post-script')
</body>
</html>

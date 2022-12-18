<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Главная страница')</title>
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <script src="/public/assets/js/bootstrap.bundle.js" defer></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                </li>
                @guest()
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                    </li>
                @endguest
                @auth()
                    @if(Auth::user()->role == 'Администратор')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Администрация
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('admin.products.create')}}">Добавить продукт</a></li>
                            </ul>
                        </li>
                    @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('order.basket')}}">Корзина</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('order.all')}}">Заказы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Выход</a>
                        </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@yield('content')
</body>
</html>

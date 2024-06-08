<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshop</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            float: left;
            line-height: 20px;
        }
        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        nav ul li.right {
            float: right;
        }
        @media screen and (max-width: 600px) {
            nav ul li {
                float: none;
                display: block;
                text-align: left;
            }
        }

        .right {
            font-size: 20px;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="/books?genre=fiction">Fiction</a></li>
        <li><a href="/books?genre=Historical">Historical</a></li>
        <li><a href="/books?genre=science fiction">Science Fiction</a></li>
        <li><a href="/books?genre=Adventure">Adventure</a></li>
        <li><a href="/books?genre=Philosophical">Philosophical</a></li>
        <li><a href="/books?genre=Others">Others</a></li>
        <li><a href="{{ route('books.create') }}">Add New Book</a></li>
        <li class="right"><a href="#">{{ __('Simple Book Web') }}</a></li>
        @auth
            <li class="right">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @else
            <li class="right"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
        @endauth
    </ul>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>

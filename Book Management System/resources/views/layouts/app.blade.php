<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Book Management System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <style>
        body {
            font-family: sans-serif;
            margin: 0; padding: 0;
        }
        header {
            background-color: #e19595;
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Left part: logo + title */
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        header img {
            height: 50px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        header img:hover {
            transform: scale(1.05);
        }

        header h1 {
            font-size: 28px;
            margin: 0;
            user-select: none;
            cursor: default;
        }

        /* Navigation aligned right */
        nav {
            display: flex;
            gap: 30px;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-end;
            min-width: 250px;
        }

        nav a {
            font-weight: 600;
            color: #000;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        nav a:hover,
        nav a:focus {
            color: #fff;
            background-color: #c14d4d;
            outline: none;
        }

        /* Logout button aligned far right */
        header form {
            margin-left: 20px;
        }

        header form button {
            background: rgba(255, 255, 255, 0.2);
            color: #000;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 18px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        header form button:hover 
        header form button:focus{
            background: rgba(231, 76, 60, 0.7);
            color: #fff;
            border: 1px solid rgba(231, 76, 60, 0.9);
        }

        /* Responsive: stack on small screens */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            nav {
                justify-content: flex-start;
                width: 100%;
                gap: 15px;
            }
            header form {
                margin-left: 0;
                width: 100%;
                display: flex;
                justify-content: flex-start;
            }
        }

        /* Container for page content */
        .container {
            padding: 20px 40px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background: #f4a6a6;
        }
        img.book-image {
            width: 50px;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <img src="{{ asset('logo.jpeg') }}" alt="Logo" title="Home" onclick="window.location='{{ url('/') }}'">
        <h1>Book Management System</h1>
    </div>

    @auth
    <nav>
        <a href="{{ route('books.index') }}">Books</a>
        <a href="{{ route('categories.index') }}">Main Categories</a>
        <a href="{{ route('subcategories.index') }}">Subcategories</a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout ({{ auth()->user()->name }})</button>
    </form>
    @endauth
</header>

<div class="container">
    @if(session('success'))
        <p class="text-success">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <div class="text-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>

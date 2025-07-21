<!DOCTYPE html>
<html>
<head>
    <title>Book Management System</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #e19595;
            padding: 15px 40px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
        }
        header img {
            height: 50px; 
            margin-right: 25px; 
            border-radius: 5px;
        }
        header h1 {
            font-size: 30px; 
            margin: 0;
        }
        .container {
            padding: 20px 40px; 
        }
    </style>
</head>
<body>

<header>
    <img src="{{ asset('logo.jpeg') }}" alt="Logo">
    <h1>Book Management System</h1>
</header>

<div class="container">
    @yield('content')
</div>

</body>
</html>

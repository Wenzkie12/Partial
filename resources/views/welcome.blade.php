<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            
            <h2>Library System</h2>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="content-left">
            <h1>Welcome to Our Library</h1>
            <p>Manage your books efficiently and explore a vast collection with ease.</p>
            <a href="{{ route('register') }}">
                <button class="signup-btn">Get Started</button>
            </a>
        </div>
        <div class="content-right">
            <img src="{{ asset('image/new.svg') }}" alt="Library Illustration" class="model">
        </div>
    </main>
</body>
</html>

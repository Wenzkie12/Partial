<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="{{ asset('css/final.css') }}">
  <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
  <nav>
    @include('layouts.navigation')
  </nav>
  <main>
    @yield('content') 
  </main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>News Portal</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col">
@include('includes.navbar')
 @yield('content')
@include('includes.footer')
</body>
</html>

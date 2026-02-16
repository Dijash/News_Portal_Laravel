<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NewsPortal | DailyNews</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

  <div class="flex min-h-screen flex-col md:flex-row">

    <!-- Admin Sidebar -->
    @include('includes.adminSidebar')

    <!-- Main Content Area -->
    @yield('adminContent')

  </div>

  <!-- Page Scripts -->
  @yield('scripts')
</body>
</html>

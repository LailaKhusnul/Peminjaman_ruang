<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>

    <!-- Bootstrap CSS (Bootstrap 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your additional CSS styles or external stylesheet links can be added here -->
    @yield('styles')

</head>
<body>

    <!-- Navbar or other common elements -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Your App</a>
            <!-- Other navbar elements -->
        </div>
    </nav>

    <!-- Content section -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper.js (Bootstrap 5) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Your additional JavaScript scripts can be added here -->
    @yield('scripts')

</body>
</html>

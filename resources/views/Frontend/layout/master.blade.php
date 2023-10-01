<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <title>@yield('title')</title>

    @include('Frontend.layout.inc.style')
</head>

<body>
    <!-- Navbar Start -->
    @include('Frontend.layout.inc.navbar')
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    @include('Frontend.layout.inc.footer')
    <!-- Footer End -->
    <!-- JavaScript Libraries -->
    @include('Frontend.layout.inc.script')

</body>

</html>

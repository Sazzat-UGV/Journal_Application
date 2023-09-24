<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <title>@yield('title')</title>

    @include('Frontend.layout.inc.style')
</head>

<body class="bg-light">

    @include('Frontend.layout.inc.navbar')
    @yield('content')


    @include('Frontend.layout.inc.footer')

    @include('Frontend.layout.inc.script')
</body>

</html>

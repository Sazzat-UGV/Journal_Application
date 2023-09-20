<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    @include('Backend.layout.inc.style')
</head>

<body>
    <div class="main-wrapper">
        @include('Backend.layout.inc.navbar')

        @include('Backend.layout.inc.sidebar')

        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')

            </div>
            @include('Backend.layout.inc.footer')
        </div>
    </div>
    @include('Backend.layout.inc.script')
</body>

</html>

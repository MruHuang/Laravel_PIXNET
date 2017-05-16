<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>

        <title>@yield('title')</title>
        @section('head')
            @include('partials.head')
        @show
    </head>
    <body>
        <div class='content col-xs-12 raw'>
            @yield('content_title')
        </div>
        <div class='central  col-xs-12 raw'>
            @yield('content_central')
        </div>
        <div class='Bottom  col-xs-12 raw'>
            @yield('content_bottom')
        </div>
    </body>
</html>

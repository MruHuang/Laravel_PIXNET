<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>

        <title>@yield('title')</title>
        @section('head')
            @include('partials.head')
        @show
    </head>
    <body>
        @include('partials.nav')
        <div class='BodyView'>
            @yield('titleText')
        </div>
        <div class='NumberInputView'>

        </div>
        <div class='NumberShowView'>
            @yield('')
        </div>
    </body>
</html>

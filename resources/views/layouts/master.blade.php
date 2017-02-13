<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::to('src/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('src/css/styles.css')}}">
    @yield('styles')
  </head>
  <body>
    @include('includes.header')
<div class="router-outlet">
  @yield('content')
</div>
  </body>
</html>

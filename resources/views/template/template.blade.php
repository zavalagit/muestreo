<!DOCTYPE html>
<html lang="es-MX">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta id="meta-csrf-token" name="csrf-token" content="{{ csrf_token() }}">
   <!--css-->
   @include('template.css')
   <!--title-->
   <title>@yield('title')</title>
</head>
<body>
  {{-- @include('include.include_preloader') --}}
  @include('template.side_nav')
  @include('template.header')
  <main>
    @yield('main')
  </main>
  @include('template.js')
  {{-- <script>
    $(document).ready(function(){
      $('.sidenav').sidenav();
    });
  </script> --}}
</body>
</html>


<!--yield

  -css
  -title
  -header
  -main
  -js

-->
  

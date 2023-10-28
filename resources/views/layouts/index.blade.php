<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/favicon.ico" />
    <title>@yield('title')</title>

    @include('layouts.partial.link')

  </head>

  <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    @include('layouts.partial.sidebar')
      <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">

        @include('layouts.partial.navbar')

        @yield('content')
      
      </main>
    @include('layouts.partial.footer')
  </body>
  
  @include('layouts.partial.script')
</html>

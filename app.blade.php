<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="{{asset('css/app.css')}}">
      <title>{{$title}}</title>
      <meta name="csrf-token" content="{{csrf_token()}}">
      <style>
          body {
              padding:20px;
          }
          .navbar {
              margin-bottom:20px;
          }
      </style>
  </head>
  <body>
      <div class="container">
          @component('component', ['current' => $current])
          @endcomponent
          <main role="main">
              @hasSection('body')
                 @yield('body')
              @endif
          </main>
      </div>
      <script type="text/JavaScript" src="{{ asset('js/app.js')}}"></script>
      @hasSection('javascript')
         @yield('javascript')
      @endif
  </body>
</html>
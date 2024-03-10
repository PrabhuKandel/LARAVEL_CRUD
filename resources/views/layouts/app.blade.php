<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> Product Management System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Delay for 5 seconds and then fade out the success message
        $("#success-message").delay(1000).fadeOut("slow");
    });
</script>
</head>
<body>
  <nav class=" d-flex justify-content-between navbar navbar-expand-sm bg-light border ">

      @auth
      <ul class="navbar-nav  ">
        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link     " href="{{ url('admin/home') }}">Home</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link     " href="{{ url('/home') }}">Home</a>
        </li>
        @endif
      </ul>
      <ul class="navbar-nav">
        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
          <a href="{{route('admin.logout')}}" class="  nav-link   "> Logout</a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{route('user.logout')}}" class="  nav-link   ">  Logout</a>
        </li>
        @endif
      </ul>
  
      @else
      <ul class=" ml-4 navbar-nav">
        @if(Route::has('login'))
      <li class="nav-item ">
        <a href="{{ route('login')  }}" class="text-sm text-gray-700 dark:text-gray-500 underline  ">Log in</a>
      </li>
      @endif

      @if(Route::has( 'register'))
      <li class="nav-item">

        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
      </li>
      @endif
    </ul>
    @endauth
    </div>
  </nav>

      @if($message = Session::get('success'))
      <div id ="success-message" class="alert alert-success alert-block">
        <strong> {{ $message}}</strong>
      </div>
     
      @endif
      @yield('main')
</body>
</html>
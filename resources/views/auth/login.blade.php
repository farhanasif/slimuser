<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Login Page</title>

    <!-- Vendor css -->
    <link href="{{asset('assets/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/slim.css')}}">

  </head>
  <body>

    <div class="signin-wrapper">
     <form action="{{route('login')}}" method="post">
      @csrf
      <div class="signin-box">
        <h2 class="slim-logo text-center"><a href="javascript:void();">Login Form<span>.</span></a></h2>
        <!-- <h2 class="signin-title-primary text-center">Welcome back!</h2>
        <h3 class="signin-title-secondary text-center">Sign in to continue.</h3> -->
        @include('partials._message')
        <div class="form-group">
          <input type="email" class="form-control" name="email" placeholder="Enter your email">
          <!-- @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif -->
        </div><!-- form-group -->
        <div class="form-group mg-b-50">
          <input type="password" class="form-control" name="password" placeholder="Enter your password">
          <!-- @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif -->
        </div><!-- form-group -->
        <button class="btn btn-primary btn-block btn-signin">Sign In</button>
        <!-- <a href="#">I forgot my password</a> -->
        <p class="mg-b-0">Don't have an account? <a href="{{route('registration')}}">Sign Up</a></p>
      </div><!-- signin-box -->
     </form>
    </div><!-- signin-wrapper -->

    <script src="{{asset('assets/lib/jquery/js/jquery.js')}}"></script>
    <script src="{{asset('assets/lib/popper.js/js/popper.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>

    <script src="{{asset('assets/js/slim.js')}}"></script>
  </body>
</html>

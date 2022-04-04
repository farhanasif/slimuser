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

    <title>Registration Page</title>

    <!-- Vendor css -->
    <link href="{{asset('assets/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/slim.css')}}">

  </head>
  <body>

    <div class="signin-wrapper">
     <form action="{{route('register')}}" method="post" data-parsley-validate>
      @csrf
      <div class="signin-box signup">
        <h2 class="slim-logo text-center"><a href="javascript:void();">Registration Form<span></span></a></h2>
        <!-- <h3 class="signin-title-primary text-center">Get Started!</h3>
        <h5 class="signin-title-secondary lh-4 text-center">It's free to signup and only takes a minute.</h5> -->

        <div class="row row-xs mg-b-10">
          <div class="col-sm">
            <input type="text" name="name" class="form-control" placeholder="Enter Name">
            @if ($errors->has('name'))
             <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="col-sm mg-t-10 mg-sm-t-0">
            <input type="email" name="email" class="form-control" placeholder="Enter Email">
            @if ($errors->has('email'))
             <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
        </div><!-- row -->

        <div class="row row-xs mg-b-10">
          <div class="col-sm">
            <input type="naumber" class="form-control" name="phone" placeholder="Enter Phone">
            @if ($errors->has('phone'))
             <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
          </div>
          <div class="col-sm mg-t-10 mg-sm-t-0">
            <input type="password" class="form-control" name="password" placeholder="Password">
            @if ($errors->has('password'))
             <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </div>
        </div><!-- row -->
        <div class="row row-xs mg-b-10">
          <div class="col-sm">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Cofirm Password">
            @if ($errors->has('password_confirmation'))
             <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>
        </div><!-- row -->
        <div class="mb-3">
          <div class="form-group mg-b-0">
            <textarea class="form-control" name="address" rows="3" placeholder="Enter Address" required></textarea>
          </div>
          @if ($errors->has('address'))
              <span class="text-danger">{{ $errors->first('address') }}</span>
          @endif
        </div>
        <button class="btn btn-primary btn-block btn-signin">Sign Up</button>

        <div class="signup-separator"><span>or signup using</span></div>

        <!-- <button class="btn btn-facebook btn-block">Sign Up Using Facebook</button>
        <button class="btn btn-twitter btn-block">Sign Up Using Twitter</button> -->

        <p class="mg-t-40 mg-b-0">Already have an account? <a href="{{route('showLoginForm')}}">Sign In</a></p>
      </div><!-- signin-box -->
     </form>
    </div><!-- signin-wrapper -->

    <script src="{{asset('assets/lib/jquery/js/jquery.js')}}"></script>
    <script src="{{asset('assets/lib/popper.js/js/popper.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>

    <script src="{{asset('assets/js/slim.js')}}"></script>
    <script src="{{asset('assets/lib/parsleyjs/js/parsley.js')}}"></script>
  </body>
</html>

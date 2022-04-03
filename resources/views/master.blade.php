<!DOCTYPE html>
<html lang="en">
  <head>
  @include('partials._css')
  </head>
  <body>
    <!-- slim-header -->
    @include('partials.header')
    <!-- slim-header -->

    <!-- Navbar slim-navbar -->
    @include('partials.navbar')
    <!-- slim-navbar -->

    <div class="slim-mainpanel">
      <div class="container">
        <div class="slim-pageheader">
          <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('dashboard-title')</li>
          </ol>
          <h6 class="slim-pagetitle">@yield('breadcrumb-title')</h6>
        </div><!-- slim-pageheader -->

        <!-- Main content -->
        @yield('container')
        <!-- /.content -->
        <!-- row -->

      </div><!-- container -->
    </div><!-- slim-mainpanel -->

    <!-- slim-footer -->
    @include('partials.footer')
    <!-- slim-footer -->

    <!-- slim-Script -->
    @include('partials._script')
    <!-- slim-Script -->
  </body>
</html>

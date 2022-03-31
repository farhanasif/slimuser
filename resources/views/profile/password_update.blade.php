@extends('master')

@section('dashboardTitle', 'Admin Password')
@section('dashboard-title', 'Profile')
@section('breadcrumb-title', 'Change Password Information')

@section('custom_css')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
  <div class="row row-sm">
    <div class="col-lg-12">
      <div class="card card-profile">
        <div class="card-body">
          <div class="media">
            @if(Auth::user()->image)
               <img src="{{asset('assets/images/'.Auth::user()->image)}}" alt="">
            @else
             <img src="http://via.placeholder.com/500x500" alt="">
            @endif
            <div class="media-body">
              <h3 class="card-profile-name">{{auth::user()->name}}</h3>
              <p class="card-profile-position">{{auth::user()->role}}</p>
              <!-- <p>San Francisco, California</p> -->
              <div class="row" id="res"></div>
              <form method="POST" action="{{route('updatePassword')}}" id="changePasswordAdminForm">
                <div class="row">
                  <div class="col-lg">
                    <label>Old Passord:</label>
                    <input class="form-control" placeholder="Enter current password" type="password" name="oldpassword" id="oldpassword">
                    <span class="text-danger error-text oldpassword_error"></span>
                  </div><!-- col -->
                  <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>New Password:</label>
                    <input class="form-control" placeholder="Enter new password" type="password" name="newpassword" id="newpassword">
                    <span class="text-danger error-text newpassword_error"></span>
                  </div><!-- col -->
                  <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>Confirm New Password:</label>
                    <input class="form-control" placeholder="ReEnter new password" type="Password" name="cnewpassword" id="cnewpassword">
                    <span class="text-danger error-text cnewpassword_error"></span>
                  </div><!-- col -->
                </div><br/>
                <button id="btn" type="submit" class="btn btn-success float-right">Update Password</button>
              </form>
            </div><!-- media-body -->
          </div><!-- media -->
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col-8 -->
  </div>
@endsection

@section('custom_script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  //alert('fdf');
 $.ajaxSetup({
     headers:{
       'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
  });
  
  $(function(){
    
    $('#changePasswordAdminForm').on('submit', function(e){
         e.preventDefault();
         $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
              $(document).find('span.error-text').text('');
            },
            success:function(data){
              if(data.status == 0){
                $.each(data.error, function(prefix, val){
                  $('span.'+prefix+'_error').text(val[0]);
                });
              }else{
                $('#changePasswordAdminForm')[0].reset();
                alert(data.msg);
              }
            }
         });
    });
    
  });
</script>

@endsection
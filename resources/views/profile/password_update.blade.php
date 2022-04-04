@extends('master')

@section('dashboardTitle', 'Admin Password')
@section('dashboard-title', 'Profile')
@section('breadcrumb-title', 'Change Password Information')

@section('custom_css')
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet">
@endsection

@section('container')
  <div class="row row-sm">
    <div class="col-lg-12">
      <div class="card card-profile">
        <div class="card-body">
          <div class="media">
            <!-- @if(Auth::user()->image)
               <img src="{{asset('assets/images/'.Auth::user()->image)}}" alt="">
            @else
             <img src="http://via.placeholder.com/500x500" alt="">
            @endif -->
            <div class="media-body">
              <!-- <h3 class="card-profile-name">{{auth::user()->name}}</h3>
              <p class="card-profile-position">{{auth::user()->role}}</p> -->
              <!-- <p>San Francisco, California</p> -->
              <div class="row" id="res"></div>
              <div class="col-md-6 offset-md-3">
                <form method="POST" action="{{route('updatePassword')}}" id="changePasswordAdminForm">
                  <div class="form-group">
                    <label>Old Passord:</label>
                    <input class="form-control" placeholder="Enter current password" type="password" name="oldpassword" id="oldpassword">
                    <span class="text-danger error-text oldpassword_error"></span>
                  </div>
                  <div class="form-group">
                    <label>New Password:</label>
                    <input class="form-control" placeholder="Enter new password" type="password" name="newpassword" id="newpassword">
                    <span class="text-danger error-text newpassword_error"></span>
                  </div>
                  <div class="form-group">
                    <label>Confirm New Password:</label>
                    <input class="form-control" placeholder="ReEnter new password" type="Password" name="cnewpassword" id="cnewpassword">
                    <span class="text-danger error-text cnewpassword_error"></span>
                  </div>
                  <div class="form-group">
                    <button id="btn" type="submit" class="btn btn-primary float-right">Update Password</button><br/>
                  </div>
                </form>
              </div><br/> 
              <div class="col-md-6 offset-md-3">
                <div style="background-color: blue; color: white;" class="card">
                  <div class="card-header text-center">
                    Conditions For Valide Password
                  </div>
                  <ul style="color:red;" class="list-group list-group-flush">
                    <li class="list-group-item">❌ Must be minimum 6 and maximum 30 characters</li>
                    <li class="list-group-item">❌ Must have at least 1 uppercase letter</li>
                    <li class="list-group-item">❌ Must have at least 1 lowercase letter</li>
                    <li class="list-group-item">❌ Must have at least 1 numeric character</li>
                    <li class="list-group-item">❌ Must have at least 1 special character<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@ $ ! % * # ? &</li>
                  </ul>
                </div>
              </div>  
            </div><!-- media-body -->
          </div><!-- media -->
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col-8 -->
  </div>
@endsection

@section('custom_script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.js"></script>
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
         Swal.fire({
              title: 'Are you sure?',
              text: "Update This Password",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#1b84e7',
              cancelButtonColor: '#dc3545',
              confirmButtonText: 'Yes, Update'
          }).then((result) => {
            console.log({result});
              if (result.value) {
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
                        Swal.fire(
                          'Success!',
                          'You Have Successfully Updated Your Password.',
                          'success'
                        )
                      }
                    }
                 });
              }
          });
      });
    
  });
</script>

@endsection
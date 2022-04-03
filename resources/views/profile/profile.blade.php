@extends('master')

@section('dashboardTitle', 'Admin Dashboard')
@section('dashboard-title', 'Profile')
@section('breadcrumb-title', 'Profile Information')

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
              <form method="POST" action="{{route('update.profile')}}" enctype="multipart/form-data" id="profile_setup_frm">
                <div class="row">
                  <div class="col-lg">
                    <label>Name:</label>
                    <input class="form-control" placeholder="Enter Name" type="text" name="name" id="name" value="{{auth::user()->name}}">
                  </div><!-- col -->
                  <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>Email:</label>
                    <input class="form-control" placeholder="Enter Email" type="email" name="email" id="email" value="{{auth::user()->email}}">
                  </div><!-- col -->
                  <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>Phone:</label>
                    <input class="form-control" placeholder="Enter Phone" type="text" name="phone" id="phone" value="{{auth::user()->phone}}">
                  </div><!-- col -->
                </div>
                <div class="row mg-t-20">
                  <div class="col-lg">
                    <label>Address:</label>
                    <textarea rows="3" class="form-control" placeholder="Enter Address" name="address" id="address">{{auth::user()->address}}</textarea>
                  </div><!-- col -->
                  <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>Select Profile Image:</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image">
                      <label class="custom-file-label custom-file-label-primary" for="customFile">Choose Image</label>
                    </div>
                  </div><!-- col -->
                  <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>Preview Profile Image:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img id="image_preview" src="{{asset('assets/images/'.Auth::user()->image)}}" style="width: 140px;height: 160px">
                    </div>
                  </div><!-- col -->
                </div>
                <button id="btn" type="submit" class="btn btn-success float-right">Update</button>
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
 $(document).ready(function(){

  // image preview
  $("#image").change(function(){
    let reader = new FileReader();

    reader.onload = (e) => {
      $("#image_preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  })

  $("#profile_setup_frm").submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:"POST",
      url: this.action,
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      success: (response) => {
        if (response.code == 400) {
          let error = '<span class="alert alert-danger">'+response.msg+'</span>';
          $("#res").html(error);
          location.reload();  
        }else if(response.code == 200){
          let success = '<span class="alert alert-success">'+response.msg+'</span>';
          $("#res").html(success);
          location.reload();  
        }
      }
    })
  })
})
</script>

@endsection
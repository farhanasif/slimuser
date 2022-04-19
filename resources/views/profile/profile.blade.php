@extends('master')

@section('dashboardTitle', 'Admin Dashboard')
@section('dashboard-title', 'Profile')
@section('breadcrumb-title', 'Profile Information')

@section('custom_css')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet">
@endsection

@section('container')
  <div class="row row-sm">
    <div class="col-lg-12">
      <div class="card card-profile">
        <div class="card-body">
          <div class="media">
             <img id="image_preview" src="{{asset('assets/images/'.Auth::user()->image)}}" style="width: 140px;height: 160px">
            <div class="media-body">
              <h3 class="card-profile-name" id="header_update">{{auth::user()->name}}</h3>
              <p class="card-profile-position">{{auth::user()->role}}</p>
              <!-- <p>San Francisco, California</p> -->
              <div class="row" id="res"></div>
              <form method="POST" action="#" enctype="multipart/form-data" id="profile_setup_frm" data-parsley-validate>
                <div class="row">
                  <div class="col-lg">
                    <label>Name:</label>
                    <input class="form-control" placeholder="Enter Name" type="text" name="name" id="name" value="{{auth::user()->name}}" required>
                  </div><!-- col -->
                  <div class="col-lg">
                    <label>Email:</label>
                    <input class="form-control" placeholder="Enter Email" type="email" name="email" id="email" value="{{auth::user()->email}}">
                  </div><!-- col -->
                  <div class="col-lg">
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
                  <!-- <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label>Preview Profile Image:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img id="image_preview" src="{{asset('assets/images/'.Auth::user()->image)}}" style="width: 140px;height: 160px">
                    </div>
                  </div> -->
                </div><br/>
                <div class="form-layout-footer">
                  <button id="btn" class="btn btn-primary bd-0"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                  <a href="{{url('dashboard')}}" class="btn btn-secondary bd-0">Cancel</a>
                </div><!-- form-layout-footer -->
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
<script src="{{asset('assets/lib/parsleyjs/js/parsley.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.js"></script>
<script>
  //alert('fdf');
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#image_preview').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#image").change(function() {
      readURL(this);
  });

  $("input[type=file]").change(function () {
        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            $(this).next(".custom-file-label").attr('data-content', fieldVal);
            $(this).next(".custom-file-label").text(fieldVal);
        }
    });

 $(document).ready(function(){

  // image preview

  $("#profile_setup_frm").submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);
    // var formData={
    //    name:$('#name').val(),
    //    email:$('#email').val(),
    //    phone:$('#phone').val(),
    //    address:$('#address').val(),
    //    image:$('#image').val(),
    // };
    // alert(formData);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "Want To Update This Profile",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1b84e7',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Yes, Update'
      }).then((result) => {
        //console.log({result});
          if (result.value) {
            var url="{{url('/update/profile')}}";
            $.ajax({
              url: url,
              method: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              dataType: 'json',
              success: (response) => {
                if (response.code == 400) {
                  let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                  $("#res").html(error);
                  //location.reload();  
                }else if(response.code == 200){
                  let success = '<span class="alert alert-success">'+response.msg+'</span>';
                  Swal.fire({
                      title:'success',
                      text: 'You Have Successfully Updated Your Profile!.',
                      type:'success',
                      confirmButtonText: 'OK'
                  }).then(function(result){
                      if (result.value) {
                          window.location.reload();
                      }
                  });

                  //location.reload();  
                }
              }
            })
          }
      });
    })
})
</script>

@endsection
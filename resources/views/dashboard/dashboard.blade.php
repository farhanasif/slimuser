@extends('master')

@section('dashboardTitle', 'Admin Dashboard')
@section('dashboard-title', 'Dashboard')
@section('breadcrumb-title', 'Dashboard Information')

@section('custom_css')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
  <div class="slim-mainpanel">
    <div class="container">

      <div class="section-wrapper">
        <label class="section-title">Accordion Style 01</label>
        <p class="mg-b-20 mg-sm-b-40">The default collapse behavior to create an accordion.</p>

        <div id="accordion" class="accordion-one" role="tablist" aria-multiselectable="true">
          <div class="card">
            <div class="card-header" role="tab" id="headingOne">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
                Making a Beautiful CSS3 Button Set
              </a>
            </div><!-- card-header -->

            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
              <div class="card-body">
                A concisely coded CSS3 button set increases usability across the board, gives you a ton of options, and keeps all the code involved to an absolute minimum. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
              <a class="collapsed tx-gray-800 transition" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Horizontal Navigation Menu Fold Animation
              </a>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" role="tab" id="headingThree">
              <a class="collapsed tx-gray-800 transition" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Creating CSS3 Button with Rounded Corners
              </a>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore.
              </div>
            </div><!-- collapse -->
          </div><!-- card -->
        </div><!-- accordion -->

        <label class="section-title">Accordion Style 01 (Colored)</label>
        <p class="mg-b-20 mg-sm-b-40">The default collapse behavior to create an accordion.</p>

        <div id="accordion2" class="accordion-one accordion-one-primary" role="tablist" aria-multiselectable="true">
          <div class="card">
            <div class="card-header" role="tab" id="headingOne2">
              <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2" class="tx-gray-800 transition">
                Making a Beautiful CSS3 Button Set
              </a>
            </div><!-- card-header -->

            <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
              <div class="card-body">
                A concisely coded CSS3 button set increases usability across the board, gives you a ton of options, and keeps all the code involved to an absolute minimum. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" role="tab" id="headingTwo2">
              <a class="collapsed tx-gray-800 transition" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                Horizontal Navigation Menu Fold Animation
              </a>
            </div>
            <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" role="tab" id="headingThree2">
              <a class="collapsed tx-gray-800 transition" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                Creating CSS3 Button with Rounded Corners
              </a>
            </div>
            <div id="collapseThree2" class="collapse" role="tabpanel" aria-labelledby="headingThree2">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore.
              </div>
            </div><!-- collapse -->
          </div><!-- card -->
        </div><!-- accordion -->
      </div><!-- section-wrapper -->
    </div><!-- container -->
  </div><!-- slim-mainpanel -->
@endsection

@section('custom_script')
<script>
 //  $(document).ready(function() {
 //    $('#all-appointmentListData').DataTable( {
 //        "info": true,
 //          "autoWidth": false,
 //          scrollX:'50vh',
 //          scrollY:'50vh',
 //        scrollCollapse: true,
 //    } );
 // } );
</script>

@endsection
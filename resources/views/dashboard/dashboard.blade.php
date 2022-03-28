@extends('master')

@section('dashboardTitle', 'Admin Dashboard')
@section('dashboard-title', 'Dashboard')
@section('breadcrumb-title', 'Dashboard Information')

@section('custom_css')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
  <div class="card card-dash-one mg-t-20">
    <div class="row no-gutters">
      <div class="col-lg-3">
        <i class="icon ion-ios-analytics-outline"></i>
        <div class="dash-content">
          <label class="tx-primary">Impressions</label>
          <h2>822,490</h2>
        </div><!-- dash-content -->
      </div><!-- col-3 -->
      <div class="col-lg-3">
        <i class="icon ion-ios-pie-outline"></i>
        <div class="dash-content">
          <label class="tx-success">Page Visits</label>
          <h2>465,183</h2>
        </div><!-- dash-content -->
      </div><!-- col-3 -->
      <div class="col-lg-3">
        <i class="icon ion-ios-stopwatch-outline"></i>
        <div class="dash-content">
          <label class="tx-purple">Commision</label>
          <h2>781,524</h2>
        </div><!-- dash-content -->
      </div><!-- col-3 -->
      <div class="col-lg-3">
        <i class="icon ion-ios-world-outline"></i>
        <div class="dash-content">
          <label class="tx-danger">Earnings</label>
          <h2>369,657</h2>
        </div><!-- dash-content -->
      </div><!-- col-3 -->
    </div><!-- row -->
  </div><!-- card -->
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
@extends('master')

@section('dashboardTitle', 'SlimUser')
@section('dashboard-title', 'Transaction')
@section('breadcrumb-title', 'Transactions Details')

@section('custom_css')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet">
@endsection

@section('container')
<div class="section-wrapper">
  <div class="table-wrapper">
    <a class="btn btn-success float-right" href="javascript:void(0)" id="createNewTransaction"> Create New Transaction</a><br/>
    <br/><table class="table table-bordered data-table"><br/>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Item</th>
                <th>Total</th>
                <th>Purchase Date</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div>
  <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div style="width: 167%!important;" class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center!important;" class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="transactionForm" name="transactionForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Item</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="item" name="item" placeholder="Enter Item" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Total</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="total" name="total" placeholder="Enter Total Amount" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mobile</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Purchase Date</label>
                        <div class="col-sm-12">
                          <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Submit
                     </button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>  
@endsection

@section('custom_script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{asset('assets/lib/parsleyjs/js/parsley.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 <script src="{{asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>
<script>
  //alert('fdf');
$(document).ready(function(){
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('transactions.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'user_name', name: 'user_name'},
            {data: 'mobile', name: 'mobile'},
            {data: 'item', name: 'item'},
            {data: 'total', name: 'total'},
            {data: 'purchase_date', name: 'purchase_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewTransaction').click(function () {
      //alert("dddff");
        $('#saveBtn').val("create-product");
        $('#id').val();
        $('#transactionForm').trigger("reset");
        $('#modelHeading').html("Create New Transaction");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editTransaction', function () {
      var id = $(this).data('id');
      $.get("{{ route('transactions.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Transaction");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#item').val(data.item);
          $('#total').val(data.total);
          $('#mobile').val(data.mobile);
          $('#purchase_date').val(data.purchase_date);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#transactionForm').serialize(),
          url: "{{ route('transactions.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#transactionForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteTransaction', function () {
        //alert('fdf');
        var id = $(this).data("id");
        //alert(id);
        confirm("Are You sure want to delete !");
        $.ajax({
            type: "DELETE",
            url: "{{ route('transactions.store') }}"+'/'+id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>

@endsection
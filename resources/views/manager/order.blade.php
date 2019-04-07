@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>ORDERS <small>(Manager)</small> </h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            {{-- <a href="#" class="btn btn-info btn-add">Add new user</a> --}}
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table id="orderTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Order ID</th>
                  <th>Total</th>
                  <th>Comfirmer</th>
                  <th>Customer</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Delivery Unit</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    $('#orderTable').DataTable({
      order: [ 0, "desc" ],
      processing: true,
      serverSide: true,
      ajax: '/admin/getOrder/{{ $type }}',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'order_code', name: 'order_code' },
      { data: 'total', name: 'total' },
      { data: 'user_id', name: 'user_id' },
      { data: 'customer_id', name: 'customer_id' },
      { data: 'address', name: 'address' },
      { data: 'customer_mobile', name: 'customer_mobile' },
      { data: 'status', name: 'status' },
      { data: 'delivery_unit', name: 'delivery_unit' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action' }
      ]
    });
  });
  
</script> 

<script type="text/javascript" src="/js/manager/order.js"></script>

@endsection
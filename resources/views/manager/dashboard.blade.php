@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Total Orders</span>
      <div class="count">{{ $orders }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
      <div class="count">{{ $products }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Product Sold</span>
      <div class="count">{{ $product_sold }}</div>
      {{-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
      <div class="count">{{ $customers }}</div>
      {{-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> --}}
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Revenue in this month</span>
      <div class="count green">{{ $revenue }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Best seller <small></small></h3>
          </div>
          <div class="col-md-6">
            <form action="" id="form-check" method="POST" role="form" enctype="multipart/form-data" >
              <div class="pull-right row form-group" style="background: #fff; cursor: pointer; padding: 5px 10px;">
              @csrf
                <div class="col-md-5 datetime">
                  <input type="text" class="form-control form_datetime" name="start-time" id="start_time" placeholder="Start time" value="">
                </div>
                <div class="col-md-5 datetime">
                  <input type="text" class="form-control form_datetime" name="end-time" id="end_time" placeholder="End time" value="">               
                </div>
                <div class="col-md-2">
                  <button class="btn btn-sm-primary" type="submit">Check</button>
                </div>
              </div>
            </form>
            
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <table class="table table-striped table-responsive">
            <thead>
              <th>Product</th>
              <th  style="width: 20%;">Thumbnail</th>
              <th>Brand</th>
              <th>Price</th>
              <th>Quantity</th>
            </thead>
            <tbody id="content">
            </tbody>
          </table>
        </div>
        
        
        <div class="clearfix"></div>
      </div>
    </div>

  </div>

</div>
@endsection
@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
  $(function () {
    $('.form_datetime').datetimepicker();
  });
</script>
<script type="text/javascript" src="/js/manager/dashboard.js"></script>
@endsection
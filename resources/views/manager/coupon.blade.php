@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>COUPONS</h3>
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
            <a href="#" class="btn btn-info btn-add">Add new coupon</a>
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

            <table id="couponTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Code</th>
                  <th>Money</th>
                  <th>Percent</th>
                  <th>Create at</th>
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


{{-- Show detail --}}
<div class="modal fade" id="modal-show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detail</h4>
      </div>
      <div class="modal-body">
        <h2  style="text-align: center;">Coupon Info</h2>
        <table class="table table-hover">
          <tbody>
            <tr>
              <td style="width: 20%; font-weight: bold;">ID</td>
              <td id="id"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Name</td>
              <td id="name"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Code</td>
              <td id="code"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Start Time </td>
              <td id="start-time"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">End Time </td>
              <td id="end-time"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Discount </td>
              <td id="discount" style=" font-weight: bold;"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Creatd at </td>
              <td id="created_at"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Updated at</td>
              <td id="updated_at"></td>
            </tr>
          </tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- Add coupon --}}
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <form action="" id="form-add" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add new coupon</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-add" name="name">
            
            <div class="row">
              <div class="datetime col-xs-6">
                <label for="">Start time<span class="required"> *</span></label>
                <input type="text" class="form-control form_datetime" name="start-time" id="start_time">
              </div>
              <div class="datetime col-xs-6">
                <label for="">End time<span class="required"> *</span></label>
                <input type="text" class="form-control form_datetime" name="end-time" id="end_time">
              </div>
            </div>

            <label for="">Code<span class="required"> *</span></label>
            <input type="text" class="form-control" id="code_add" name="code">
            
            <label for="">Money</label>
            <input type="number" class="form-control" id="money_add" name="money" value="0">
            
            <label for="">Percent</label>
            <input type="number" class="form-control" id="percent_add" name="percent" value="0">
          </div> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Edit cate --}}
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" id="form-edit" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit coupon</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id-edit" name="id">

            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-edit" name="name">

            <label for="">Code<span class="required"> *</span></label>
            <input type="text" class="form-control" id="code-edit" name="code">
            
            <div class="row">
              <div class="datetime col-xs-6">
                <label for="">Start time<span class="required"> *</span></label>
                <input type="text" class="form-control form_datetime" name="start-time" id="start-edit">
              </div>
              <div class="datetime col-xs-6">
                <label for="">End time<span class="required"> *</span></label>
                <input type="text" class="form-control form_datetime" name="end-time" id="end-edit">
              </div>
            </div>
            
            <label for="">Money</label>
            <input type="number" class="form-control" id="money-edit" name="money">
            
            <label for="">Percent</label>
            <input type="number" class="form-control" id="percent-edit" name="percent">
          </div> 
        </div> 
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="edit">Edit</button>

        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
<script type="text/javascript">
  $(document).ready(function () {
    $('#couponTable').DataTable({
      order: [ 0, "desc" ],
      processing: true,
      serverSide: true,
      ajax: '/admin/getCoupon',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'start_time', name: 'start_time' },
      { data: 'end_time', name: 'end_time' },
      { data: 'code', name: 'code' },
      { data: 'money', name: 'money' },
      { data: 'percent', name: 'percent' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action' }
      ]
    });

    
  });
  $(function () {
    $('.form_datetime').datetimepicker();
  });
  
</script> 

<script type="text/javascript" src="/js/manager/coupon.js"></script>

@endsection
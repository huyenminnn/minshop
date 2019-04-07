@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>EMPLOYEES</h3>
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
            <a href="#" class="btn btn-info btn-add">Add new employee</a>
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

            <table id="employeeTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Branch</th>
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
        <h2  style="text-align: center;">Employee Info</h2>
        <img id="avatar" style="height: 250px;width: 50%; margin-left: 25%; margin-bottom: 20px;">
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
              <td style="width: 20%; font-weight: bold;">Email</td>
              <td id="email"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Address</td>
              <td id="address"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Mobile </td>
              <td id="mobile"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Gender </td>
              <td id="gender"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Salary </td>
              <td id="salary"></td>
            </tr>
            <tr>
              <td style="width: 20%; font-weight: bold;">Branch </td>
              <td id="branch"></td>
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

{{-- Add cate --}}
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <form action="" id="form-add" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add new employee</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-add" name="name">

            <label for="">Avatar<span class="required"> *</span></label>
            <input type="file" class="form-control" id="avatar-add" name="avatar">
  
            <label for="">Email<span class="required"> *</span></label>
            <input type="text" class="form-control" id="email-add" name="email">
            
            <label for="">Gender<span class="required"> *</span></label>
            <select class="form-control" id="gender-add" name="gender">
              <option value="Nam">Female</option>
              <option value="Nu">Male</option>
              <option value="Khac">Other</option>
            </select>

            <label for="">Address<span class="required"> *</span></label>
            <input type="text" class="form-control" id="address-add" name="address">
            
            <label for="">Mobile<span class="required"> *</span></label>
            <input type="text" class="form-control" id="mobile-add" name="mobile">

            <label for="">Salary<span class="required"> *</span></label>
            <input type="text" class="form-control" id="salary-add" name="salary">

            <label for="">Branch<span class="required"> *</span></label>
            <select class="form-control" id="branch-add" name="branch">
              <option value="0">None</option>
              @foreach($branches as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
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
          <h4 class="modal-title">Edit employee</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <img id="avatarShow-edit" style="height: 250px;width: 50%; margin:0px 25% 20px 25%;">
            <input type="hidden" class="form-control" id="id-edit" name="id">

            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-edit" name="name">

            <label for="">Avatar<span class="required"> *</span></label>
            <input type="file" class="form-control" id="avatar-edit" name="avatar">
  
            <label for="">Email<span class="required"> *</span></label>
            <input type="text" class="form-control" id="email-edit" name="email">
            
            <label for="">Gender<span class="required"> *</span></label>
            <select class="form-control" id="gender-edit" name="gender">
              <option value="Nam">Female</option>
              <option value="Nu">Male</option>
              <option value="Khac">Other</option>
            </select>

            <label for="">Address<span class="required"> *</span></label>
            <input type="text" class="form-control" id="address-edit" name="address">
            
            <label for="">Mobile<span class="required"> *</span></label>
            <input type="text" class="form-control" id="mobile-edit" name="mobile">

            <label for="">Salary<span class="required"> *</span></label>
            <input type="text" class="form-control" id="salary-edit" name="salary">

            <label for="">Branch<span class="required"> *</span></label>
            <select class="form-control" id="branch-edit" name="branch">
              <option value="0">None</option>
              @foreach($branches as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
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
<script type="text/javascript">
  $(document).ready(function () {
    $('#employeeTable').DataTable({
      order: [ 0, "desc" ],
      processing: true,
      serverSide: true,
      ajax: '/admin/getEmployee',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'avatar', name: 'avatar' },
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'gender', name: 'gender' },
      { data: 'address', name: 'address' },
      { data: 'mobile', name: 'mobile' },
      { data: 'branch', name: 'branch' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action' }
      ]
    });
  });
  
</script> 

<script type="text/javascript" src="/js/manager/employee.js"></script>

@endsection
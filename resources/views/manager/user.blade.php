@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>USERS <small>(Manager)</small> </h3>
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
            <a href="#" class="btn btn-info btn-add">Add new user</a>
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

            <table id="userTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Created at</th>
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
        <h2  style="text-align: center;">User Info</h2>
        <img class="img-circle" id="avatar" style="height: 250px;width: 250px; margin-left: 25%; margin-bottom: 20px;" >
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
              <td style="width: 20%; font-weight: bold;">Role</td>
              <td id="role"></td>
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

{{-- Add user --}}
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <form action="" id="form-add" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add new user</h4>
        </div>
        <div class="modal-body">
            <label for="">(Password is default)</label>

          <div class="form-group">
            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-add" name="name">

            <label for="">Avatar<span class="required"> *</span></label>
            <input type="file" class="form-control" id="avatar-add" name="avatar">
  
            <label for="">Email<span class="required"> *</span></label>
            <input type="text" class="form-control" id="email-add" name="email">

            <label for="">Role<span class="required"> *</span></label>
            <select class="form-control" id="role-add" name="role">
              @foreach($roles as $item)
              <option value="{{ $item->id }}">{{ $item->display_name }}</option>
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

{{-- Edit user --}}
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" id="form-edit" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit customer </h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <img id="avatarShow-edit" class="img-circle" style="height: 250px;width: 250px; margin:0px 25% 20px 25%;">
            <input type="hidden" class="form-control" id="id-edit" name="id">

            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-edit" name="name">

            <label for="">Avatar<span class="required"> *</span></label>
            <input type="file" class="form-control" id="avatar-edit" name="avatar">
  
            <label for="">Email<span class="required"> *</span></label>
            <input type="text" class="form-control" id="email-edit" name="email">
            
            <label for="">Role<span class="required"> *</span></label>
            <select class="form-control" id="role-edit" name="role">
              @foreach($roles as $item)
              <option value="{{ $item->id }}">{{ $item->display_name }}</option>
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
    $('#userTable').DataTable({
      order: [ 0, "desc" ],
      processing: true,
      serverSide: true,
      ajax: '/admin/getUser',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'avatar', name: 'avatar' },
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'role', name: 'role' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action' }
      ]
    });
  });
  
</script> 

<script type="text/javascript" src="/js/manager/user.js"></script>

@endsection
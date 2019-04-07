@extends('manager.master')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>PRODUCTS</h3>
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
            <a href="#" class="btn btn-info btn-add">Add new product</a>
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

            <table id="productTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Product Code</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Price with discount</th>
                  <th>Creator</th>
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

{{-- Add product --}}
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <form action="" id="form-add" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add new product</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-add" name="name">

            <label for="">Product Code<span class="required"> *</span></label>
            <input type="text" class="form-control" id="product-code-add" name="product-code">

            <label for="">Category<span class="required"> *</span></label>
            <select class="form-control" id="category-add" name="branch">
              @foreach($categories as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>

            <label for="">Slug<span class="required"> *</span></label>
            <input type="text" class="form-control" id="slug-add" name="slug">
            
            <label for="">Brand<span class="required"> *</span></label>
            <input type="text" class="form-control" id="brand-add" name="brand">

            <label for="">Price<span class="required"> *</span></label>
            <input type="number" class="form-control" id="price-add" name="price">

            <label for="">Description</label>
            <textarea type="text" class="form-control" id="description-add" name="description" rows="3"></textarea>

            <label for="">Product Info</label>
            <textarea type="text" class="form-control" id="product-info-add" name="product-info" rows="3"></textarea>
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
          <h4 class="modal-title">Edit product</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id-edit" name="id">

            <label for="">Name<span class="required"> *</span></label>
            <input type="text" class="form-control" id="name-edit" name="name">

            <label for="">Product Code<span class="required"> *</span></label>
            <input type="text" class="form-control" id="product-code-edit" name="product-code">

            <label for="">Category<span class="required"> *</span></label>
            <select class="form-control" id="category-edit" name="category">
              @foreach($categories as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>

            <label for="">Slug<span class="required"> *</span></label>
            <input type="text" class="form-control" id="slug-edit" name="slug">
            
            <label for="">Brand<span class="required"> *</span></label>
            <input type="text" class="form-control" id="brand-edit" name="brand">

            <label for="">Price<span class="required"> *</span></label>
            <input type="number" class="form-control" id="price-edit" name="price">

            <label for="">Description</label>
            <textarea type="text" class="form-control" id="description-edit" name="description" rows="3"></textarea>

            <label for="">Product Info</label>
            <textarea type="text" class="form-control" id="product-info-edit" name="product-info" rows="3"></textarea>
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

{{-- Add picture --}}
<div class="modal fade" id="modal-add-pic">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="admin/upload-image" class="dropzone" id="myDropzone">
        @csrf
        <div class="fallback">
          <input name="file" type="file" multiple />
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    $('#productTable').DataTable({
      order: [ 0, "desc" ],
      processing: true,
      serverSide: true,
      ajax: '/admin/getProduct',
      columns: [
      { data: 'product_code', name: 'product_code' },
      { data: 'name', name: 'name' },
      { data: 'category_id', name: 'category_id' },
      { data: 'brand', name: 'brand' },
      { data: 'price', name: 'price' },
      { data: 'discount_price', name: 'discount_price' },
      { data: 'user_id', name: 'user_id' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action' }
      ]
    });
  });
  
</script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript" src="/js/manager/product.js"></script>

@endsection
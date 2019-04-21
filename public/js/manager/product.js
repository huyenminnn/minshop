$(document).ready(function () {
	// create slug
	function toSlug(str) {
		//Đổi chữ hoa thành chữ thường
		slug = str.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            return slug;
        }

	//add picture
	$('body').on('click','.btn-pic', function(){
		$('#modal-add-pic').modal('show')
		var id = $(this).data('id')
		$('#id-add-pic').val(id)
		$('.images-product').children().remove()
		$.ajax({
			type: "get",
			url: '/admin/image/' + id,
			success: function (response){
				jQuery.each( response, function( key, val ) {
					$('.images-product').append(
						`<div class="col-md-3 col-sm-12 col-xs-12 text-center">
						<img src="/storage/`+val.image+`" class="img-responsive img-fluid img-rounded" style="height: 300px; margin:15px auto;">
						<button type="button" class="btn btn-danger delete-image" data-id=`+val.id+`>Delete</button>
						</div>`
						);
				});
			}
		})
	})

	Dropzone.options.myDropzone = {
		maxFileSize : 10,
		parallelUploads : 10,
		uploadMultiple: true,
		autoProcessQueue : false,
		addRemoveLinks : true,
		init: function() {
			var submitButton = document.querySelector("#submit-pic")
			myDropzone = this;
			submitButton.addEventListener("click", function() {
				myDropzone.processQueue(); 
				$('#modal-add-pic').modal('hide')
				toastr.success('Edit images success!')
			});

		},
	}

	// add new product
	$('.btn-add').click(function(){
		$('#modal-add').modal('show')
		$("input").focus(function(){
			if ($(this).next().attr('class') == 'error-noti') {
				$(this).next().remove();
			}
		});

		$('#name-add').keyup(function(){
			var slug = toSlug($('#name-add').val())
			$('#slug-add').val(slug)
		})

		$('#price-add').keyup(function(){
			var val = $('#price-add').val()
			var a = numeral(val).format('0,0')
			$('#price-add').val(a)
			$('#price-discount-add').val(a)
		})

		$('#price-discount-add').keyup(function(){
			var val = $('#price-discount-add').val()
			var a = numeral(val).format('0,0')
			$('#price-discount-add').val(a)
		})
		
	})

	$('#form-add').submit(function(e){

		e.preventDefault()
		$('.error-noti').remove()

		var data = new FormData();
		if ($('#thumbnail-add')[0].files[0]) {
			data.append('thumbnail',$('#thumbnail-add')[0].files[0])
		} else data.append('thumbnail','')
		data.append('name',$('#name-add').val())
		data.append('product_code',$('#product-code-add').val())
		data.append('category_id',$('#category-add').val())
		data.append('slug',$('#slug-add').val())
		data.append('price',numeral($('#price-add').val()).value())
		data.append('discount_price',numeral($('#price-discount-add').val()).value())
		data.append('brand',$('#brand-add').val())
		data.append('description',tinymce.get('description-add').getContent())
		data.append('product_info',tinymce.get('product-info-add').getContent())

		$.ajax({
			type: "post",
			url: '/admin/product',
			data: data,
			processData: false,
			contentType: false,
			success: function(data, textStatus, jqXHR) {
				$('#modal-add').modal('hide')
				toastr.success('Add product success!')
				$('#productTable').DataTable().ajax.reload(null,false);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
				}
				if (data.responseJSON.errors.slug) {
					$( '<p class="error-noti">'+data.responseJSON.errors.slug[0]+"</p>" ).insertAfter( "#slug-add" );
				}
				if (data.responseJSON.errors.thumbnail) {
					$( '<p class="error-noti">'+data.responseJSON.errors.thumbnail[0]+"</p>" ).insertAfter( "#thumbnail-add" );
				}
				if (data.responseJSON.errors.product_code) {
					$( '<p class="error-noti">'+data.responseJSON.errors.product_code[0]+"</p>" ).insertAfter( "#product-code-add" );
				}
				if (data.responseJSON.errors.brand) {
					$( '<p class="error-noti">'+data.responseJSON.errors.brand[0]+"</p>" ).insertAfter( "#brand-add" );
				}
				if (data.responseJSON.errors.price) {
					$( '<p class="error-noti">'+data.responseJSON.errors.price[0]+"</p>" ).insertAfter( "#price-add" );
				}
			},
		});
	})

	// edit product
	$('body').on('click','.btn-edit', function(){

		$('#modal-edit').modal('show')
		
		$("input").focus(function(){
			if ($(this).next().attr('class') == 'error-noti') {
				$(this).next().remove();
			}
		});

		$('#name-edit').keyup(function(){
			var slug = toSlug($('#name-edit').val())
			$('#slug-edit').val(slug)
		})

		$('#price-edit').keyup(function(){
			var val = $('#price-edit').val()
			var a = numeral(val).format('0,0')
			$('#price-edit').val(a)
			$('#price-discount-edit').val(a)
		})

		$('#price-discount-edit').keyup(function(){
			var val = $('#price-discount-edit').val()
			var a = numeral(val).format('0,0')
			$('#price-discount-edit').val(a)
		})

		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/product_showedit/' + id,     
			
			success: function (response){
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name) 
				$('#slug-edit').val(response.slug) 
				$('#product-code-edit').val(response.product_code) 
				$('#category-edit').val(response.category_id)
				$('#brand-edit').val(response.brand)
				$('#price-edit').val(numeral(response.price).format('0,0'))
				$('#price-discount-edit').val(numeral(response.discount_price).format('0,0'))
				tinymce.get('description-edit').setContent(response.description)
				tinymce.get('product-info-edit').setContent(response.product_info)
				$('#thumbnailShow-edit').attr('src','/storage/'+response.thumbnail)
			}
		})
	})
	$('#form-edit').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		var id = $('#id-edit').val()

		var data = new FormData();
		data.append('id',id)
		if ($('#thumbnail-edit')[0].files[0]) {
			data.append('thumbnail',$('#thumbnail-edit')[0].files[0])
		} else data.append('thumbnail','none')
		data.append('name',$('#name-edit').val())
		data.append('product_code',$('#product-code-edit').val())
		data.append('category_id',$('#category-edit').val())
		data.append('slug',$('#slug-edit').val())
		data.append('price',numeral($('#price-edit').val()).value())
		data.append('discount_price',numeral($('#price-discount-edit').val()).value())
		data.append('brand',$('#brand-edit').val())
		data.append('description',tinymce.get('description-edit').getContent())
		data.append('product_info',tinymce.get('product-info-edit').getContent())

		$.ajax({
			type: 'post',
			url: '/admin/product_edit/' + id,
			data: data,
			processData: false,
			contentType: false,
			success: function (response){
				toastr.success('Update product success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')
					$('#productTable').DataTable().ajax.reload(null,false);
				},800);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
				}
				if (data.responseJSON.errors.slug) {
					$( '<p class="error-noti">'+data.responseJSON.errors.slug[0]+"</p>" ).insertAfter( "#slug-add" );
				}
				if (data.responseJSON.errors.product_code) {
					$( '<p class="error-noti">'+data.responseJSON.errors.product_code[0]+"</p>" ).insertAfter( "#product-code-add" );
				}
				if (data.responseJSON.errors.brand) {
					$( '<p class="error-noti">'+data.responseJSON.errors.brand[0]+"</p>" ).insertAfter( "#brand-add" );
				}
				if (data.responseJSON.errors.price) {
					$( '<p class="error-noti">'+data.responseJSON.errors.price[0]+"</p>" ).insertAfter( "#price-add" );
				}
			},
		})
	})
	

	// delete product
	$('body').on('click','.btn-delete', function(e){
		e.preventDefault()
		var id = $(this).data('id')
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this imaginary file!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: 'delete',
					url: '/admin/product/' + id,
					success: function (response) {
						// thông báo xoá thành công bằng toastr
						toastr.success('Delete product success!')
						setTimeout(function () {
							$('#productTable').DataTable().ajax.reload(null,false);
						},800);
					},
					error: function (error) {
					}
				})
			}
		});
	})

	//delete image of product
	$('body').on('click','.delete-image',function(e){
		e.preventDefault()
		var id = $(this).data('id')
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this image!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$(this).parent().remove()
				$.ajax({
					type: 'delete',
					url: '/admin/image/' + id,
					success: function (response) {
						// thông báo xoá thành công bằng toastr
						toastr.success('Delete image success!')
					},
					error: function (error) {
					}
				})
			}
		});
	})

	// detail product
	$('body').on('click','.btn-show', function(){
		$('#modal-show').modal('show')
		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/product/' + id,   
			success: function (response){
				$('#product-id-detail').val(response.id)
				$('.name-product').html(response.name)
			}
		})
		$('#productDetailTable').DataTable({
			order: [ 0, "desc" ],
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: '/admin/detailProduct/'+id,
			columns: [
			{ data: 'product_id', name: 'product_id' },
			{ data: 'size', name: 'size' },
			{ data: 'color_id', name: 'color_id' },
			{ data: 'quantity', name: 'quantity' },
			{ data: 'action', name: 'action' }
			],

		});
		
	})

	// add new product detail
	$('.btn-add-product').click(function(){
		$('#modal-add-product').modal('show')
		$("input").focus(function(){
			if ($(this).next().attr('class') == 'error-noti') {
				$(this).next().remove();
			}
		});
	})

	$('#form-add-product').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		$.ajax({
			type: "post",
			url: '/admin/detailProduct',
			data: {
				product_id: $('#product-id-detail').val(),
				color_id: $('#color-add').val(),
				size: $('#size-add').val(),
				quantity: $('#quantity-add').val(),
			},
			success: function(data, textStatus, jqXHR) {
				$('#modal-add-product').modal('hide')
				toastr.success('Add product success!')
				$('#productDetailTable').DataTable().ajax.reload(null,false);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.color_id) {
					$( '<p class="error-noti">'+data.responseJSON.errors.color_id[0]+"</p>" ).insertAfter( "#color-add" );
				}
				if (data.responseJSON.errors.size) {
					$( '<p class="error-noti">'+data.responseJSON.errors.size[0]+"</p>" ).insertAfter( "#size-add" );
				}
				if (data.responseJSON.errors.quantity) {
					$( '<p class="error-noti">'+data.responseJSON.errors.quantity[0]+"</p>" ).insertAfter( "#quantity-add" );
				}

			},
		});
	})

	// edit product detail
	$('body').on('click','.btn-edit-product', function(){

		$('#modal-edit-product').modal('show')		
		$("input").focus(function(){
			if ($(this).next().attr('class') == 'error-noti') {
				$(this).next().remove();
			}
		});

		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/detailProduct_edit/' + id,     
			
			success: function (response){
				$('#id-edit-product').val(response.id) 
				$('#size-edit').val(response.size) 
				$('#color-edit').val(response.color_id) 
				$('#quantity-edit').val(response.quantity) 
				console.log($('#product-id-detail').val())				
			}
		})
	})
	$('#form-edit-product').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		var id = $('#id-edit-product').val()
		$.ajax({
			type: 'post',
			url: '/admin/product_detail_edit/' + id,
			data:{
				id: id,
				product_id: $('#product-id-detail').val(),
				color_id: $('#color-edit').val(),
				size: $('#size-edit').val(),
				quantity: $('#quantity-edit').val(),
			},
			success: function (response){
				toastr.success('Update product success!')
				setTimeout(function () {
					$('#modal-edit-product').modal('hide')
					$('#productDetailTable').DataTable().ajax.reload(null,false);
				},800);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
				}
				if (data.responseJSON.errors.slug) {
					$( '<p class="error-noti">'+data.responseJSON.errors.slug[0]+"</p>" ).insertAfter( "#slug-add" );
				}
				if (data.responseJSON.errors.product_code) {
					$( '<p class="error-noti">'+data.responseJSON.errors.product_code[0]+"</p>" ).insertAfter( "#product-code-add" );
				}
				if (data.responseJSON.errors.brand) {
					$( '<p class="error-noti">'+data.responseJSON.errors.brand[0]+"</p>" ).insertAfter( "#brand-add" );
				}
				if (data.responseJSON.errors.price) {
					$( '<p class="error-noti">'+data.responseJSON.errors.price[0]+"</p>" ).insertAfter( "#price-add" );
				}
			},
		})
	})

	//delete product detail
	$('body').on('click','.btn-delete-product',function(e){
		e.preventDefault()
		var id = $(this).data('id')
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this image!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: 'delete',
					url: '/admin/detailProduct/' + id,
					success: function (response) {
						// thông báo xoá thành công bằng toastr
						toastr.success('Delete product success!')
						setTimeout(function () {
							$('#productDetailTable').DataTable().ajax.reload(null,false);
						},800);
					},
					error: function (error) {
					}
				})
			}
		});
	})
})



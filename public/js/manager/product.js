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
		
		$.ajax({
			
		})
	})

	// detail product
	$('body').on('click','.btn-show', function(){

		$('#modal-show').modal('show')

		var id = $(this).data('id')
		
		$.ajax({
			
		})
	})

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
	})

	$('#form-add').submit(function(e){

		e.preventDefault()
		$('.error-noti').remove()
		$.ajax({
			type: "post",
			url: '/admin/product',
			data: {
				name: $('#name-add').val(),
				product_code: $('#product-code-add').val(),
				category_id: $('#category-add').val(),
				slug: $('#slug-add').val(),
				brand: $('#brand-add').val(),
				price: $('#price-add').val(),
				description: tinymce.get('description-add').getContent(),
				product_info: tinymce.get('product-info-add').getContent(),
			},
			success: function(data, textStatus, jqXHR) {
				$('#modal-add').modal('hide')
				toastr.success('Add product success!')
				$('#productTable').DataTable().ajax.reload();
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
				$('#price-edit').val(response.price)
				tinymce.get('description-edit').setContent(response.description)
				tinymce.get('product-info-edit').setContent(response.product_info)
			}
		})
	})
	$('#form-edit').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		var id = $('#id-edit').val()
		$.ajax({
			type: 'post',
			url: '/admin/product_edit/' + id,
			data:{
				id: id,
				name: $('#name-edit').val(),
				slug: $('#slug-edit').val(),
				brand: $('#brand-edit').val(),
				price: $('#price-edit').val(),
				product_code: $('#product-code-edit').val(),
				category_id: $('#category-edit').val(),
				description: tinymce.get('description-edit').getContent(),
				product_info: tinymce.get('product-info-edit').getContent(),
			},
			success: function (response){
				toastr.success('Update product success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')
					$('#productTable').DataTable().ajax.reload();
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
							$('#productTable').DataTable().ajax.reload();
						},800);
					},
					error: function (error) {
					}
				})
			}
		});
	})

	
})



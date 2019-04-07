$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function () {
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

	$('body').on('click','.btn-show', function(){

		$('#modal-show').modal('show')

		var id = $(this).data('id')
		
		$.ajax({
			type: 'get',
			url: '/admin/category/' + id,     //link chuyen den show, ham show tren controler tra ve ban ghi duoc chon
			// data:
			success: function (response){
				console.log(response)
				$('#id').html(response.id)   //response.sth: sth la cot muon chon
				$('#name').html(response.name)
				if (response.parent_id == 0) {
					$('#parent-id').html('None')
				}else {
					$('#parent-id').html(response.parent_id)
				}
				$('#slug').html(response.slug)
				$('#description').html(response.description)
				$('#created_at').html(response.created_at)
				$('#updated_at').html(response.updated_at)
			}
		})
	})

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
			url: '/admin/category',
			data: {
				name: $('#name-add').val(),
				parent_id: $('#parent_id').val(),
				slug: $('#slug-add').val(),
				description: tinymce.get('description-add').getContent(),
			},
			success: function(data, textStatus, jqXHR) {
				$('#modal-add').modal('hide')
				toastr.success('Add category success!')
				$('#categoryTable').DataTable().ajax.reload();
			},
			error: function(data, textStatus, jqXHR) {
	       	if (data.responseJSON.errors.name) {
	       		$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
	       	}
	       	if (data.responseJSON.errors.slug) {
	       		$( '<p class="error-noti">'+data.responseJSON.errors.slug[0]+"</p>" ).insertAfter( "#slug-add" );
	       	}
	       },
	   });
	})


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
			url: '/admin/category/' + id,     
			
			success: function (response){
				console.log()
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name) 
				$('#parent-edit').val(response.parent_id)
				$('#slug-edit').val(response.slug)
				tinymce.get('description-edit').setContent(response.description)
			}
		})
	})
	$('#form-edit').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		var id = $('#id-edit').val()
		$.ajax({
			type: 'post',
			url: '/admin/category_edit/' + id,
			data:{
				id: id,
				name: $('#name-edit').val(),
				parent_id: $('#parent_edit').val(),
				slug: $('#slug-edit').val(),
				description: tinymce.get('description-edit').getContent(),
			},
			success: function (response){
				toastr.success('Update category success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')

					$('#categoryTable').DataTable().ajax.reload();
				},800);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-edit" );
				}
				if (data.responseJSON.errors.slug) {
					$( '<p class="error-noti">'+data.responseJSON.errors.slug[0]+"</p>" ).insertAfter( "#slug-edit" );
				}
	           },
	       })
	})
	

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
					url: '/admin/category/' + id,
					success: function (response) {
						// thông báo xoá thành công bằng toastr
						toastr.success('Delete category success!')
						setTimeout(function () {
							$('#categoryTable').DataTable().ajax.reload();
						},800);
					},
					error: function (error) {
					}
				})
			}
		});
	})

	
})



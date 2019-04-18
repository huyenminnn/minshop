$(document).ready(function () {
	$('body').on('click','.btn-show', function(){
		$('#modal-show').modal('show')
		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/permission/' + id,     
			// data:
			success: function (response){
				$('#id').html(response.id)  
				$('#name').html(response.name)
				$('#display-name').html(response.display_name)
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
	})

	$('#form-add').submit(function(e){

		e.preventDefault()
		$('.error-noti').remove()
		$.ajax({
			type: "post",
			url: '/admin/permission',
			data: {
				name: $('#name-add').val(),
				display_name: $('#display-add').val(),
				description: tinymce.get('description-add').getContent(),
			},
	        success: function(data, textStatus, jqXHR) {
	        	$('#modal-add').modal('hide')
	        	toastr.success('Add permission success!')
	        	$('#permissionTable').DataTable().ajax.reload(null, false);
	       },
	       error: function(data, textStatus, jqXHR) {
	           	if (data.responseJSON.errors.name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
	           	}
	           	if (data.responseJSON.errors.display_name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.display_name[0]+"</p>" ).insertAfter( "#display-add" );
	           	}
	       },
	   });
	})


	$('body').on('click','.btn-edit', function(){

		$('#modal-edit').modal('show')
		var id = $(this).data('id')

		$("input").focus(function(){
			if ($(this).next().attr('class') == 'error-noti') {
				$(this).next().remove();
			}
		});

		$.ajax({
			type: 'get',
			url: '/admin/permission/' + id,     
			
			success: function (response){
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name)	
				$('#display-edit').val(response.display_name)	
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
			url: '/admin/permission_edit/' + id,
			data: {
				id: id,
				name: $('#name-edit').val(),
				display_name: $('#display-edit').val(),
				description: tinymce.get('description-edit').getContent(),
			},
			success: function (response){
				toastr.success('Update permission success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')
					$('#permissionTable').DataTable().ajax.reload(null, false);
				},800);
			},
			error: function(data, textStatus, jqXHR) {
	           	if (data.responseJSON.errors.name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-edit" );
	           	}
	           	if (data.responseJSON.errors.display_name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.display_name[0]+"</p>" ).insertAfter( "#display-edit" );
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
				//phương thức delete
				type: 'delete',
				url: '/admin/permission/' + id,
				success: function (response) {
					// thông báo xoá thành công bằng toastr
					toastr.success('Delete permission success!')
					setTimeout(function () {
						$('#permissionTable').DataTable().ajax.reload(null, false);
					},800);
				},
				error: function (error) {
				}
			})
			}
		});
	})
})



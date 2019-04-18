$(document).ready(function () {
	$('body').on('click','.btn-show', function(){
		$('#modal-show').modal('show')
		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/user/' + id,     
			// data:
			success: function (response){
				$('#id').html(response.id)  
				$('#name').html(response.name)
				$('#email').html(response.email)
				$('#role').html(response.role)
				$('#created_at').html(response.created)
				$('#updated_at').html(response.updated)
				$('#avatar').attr('src','/storage/'+response.avatar)
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

		var data = new FormData();
		if ($('#avatar-add')[0].files[0]) {
			data.append('avatar',$('#avatar-add')[0].files[0])
		} else data.append('avatar','')
		data.append('name',$('#name-add').val())
		data.append('email',$('#email-add').val())
		data.append('role',$('#role-add').val())
		$.ajax({
			type: "post",
			url: '/admin/user',
			data: data,
			processData: false,
			contentType: false,
	        success: function(data, textStatus, jqXHR) {
	        	$('#modal-add').modal('hide')
	        	toastr.success('Add user success!')
	        	$('#userTable').DataTable().ajax.reload();
	       },
	       error: function(data, textStatus, jqXHR) {
	           	if (data.responseJSON.errors.name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
	           	}
	           	if (data.responseJSON.errors.email) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.email[0]+"</p>" ).insertAfter( "#email-add" );
	           	}
	           	if (data.responseJSON.errors.address) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.address[0]+"</p>" ).insertAfter( "#address-add" );
	           	}
	           	if (data.responseJSON.errors.mobile) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.mobile[0]+"</p>" ).insertAfter( "#mobile-add" );
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
			url: '/admin/user/' + id,     
			
			success: function (response){
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name)	
				$('#email-edit').val(response.email)
				$('#role-edit').val(response.role)
				$('#avatarShow-edit').attr('src','/storage/'+response.avatar)
			}
		})
	})
	
	$('#form-edit').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()

		var id = $('#id-edit').val()

		var data = new FormData();
		data.append('id',id)
		if ($('#avatar-edit')[0].files[0]) {
			data.append('avatar',$('#avatar-edit')[0].files[0])
		} else data.append('avatar','none')

		data.append('name',$('#name-edit').val())
		data.append('email',$('#email-edit').val())
		data.append('role',$('#role-edit').val())
		$.ajax({
			type: 'post',
			url: '/admin/user_edit/' + id,
			data: data,
			processData: false,
			contentType: false,
			success: function (response){
				toastr.success('Update user success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')
					$('#userTable').DataTable().ajax.reload();
				},800);
			},
			error: function(data, textStatus, jqXHR) {
	           	if (data.responseJSON.errors.name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-edit" );
	           	}
	           	if (data.responseJSON.errors.email) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.email[0]+"</p>" ).insertAfter( "#email-edit" );
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
				url: '/admin/user/' + id,
				success: function (response) {
					// thông báo xoá thành công bằng toastr
					toastr.success('Delete user success!')
					setTimeout(function () {
						$('#userTable').DataTable().ajax.reload();
					},800);
				},
				error: function (error) {
				}
			})
			}
		});
	})
})



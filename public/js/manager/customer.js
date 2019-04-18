$(document).ready(function () {
	$('body').on('click','.btn-show', function(){
		$('#modal-show').modal('show')
		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/customer/' + id,     
			// data:
			success: function (response){
				$('#id').html(response.id)  
				$('#name').html(response.name)
				$('#email').html(response.email)
				$('#address').html(response.address)
				$('#gender').html(response.gender)
				$('#mobile').html(response.mobile)
				$('#level').html(response.level)
				$('#created_at').html(response.created_at)
				$('#updated_at').html(response.updated_at)
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
		data.append('gender',$('#gender-add').val())
		data.append('address',$('#address-add').val())
		data.append('mobile',$('#mobile-add').val())
		$.ajax({
			type: "post",
			url: '/admin/customer',
			data: data,
			processData: false,
			contentType: false,
	        success: function(data, textStatus, jqXHR) {
	        	$('#modal-add').modal('hide')
	        	toastr.success('Add customer success!')
	        	$('#customerTable').DataTable().ajax.reload();
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
			url: '/admin/customer/' + id,     
			
			success: function (response){
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name)	
				$('#gender-edit').val(response.gender)
				$('#mobile-edit').val(response.mobile)
				$('#address-edit').val(response.address)
				$('#email-edit').val(response.email)
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
		data.append('gender',$('#gender-edit').val())
		data.append('address',$('#address-edit').val())
		data.append('mobile',$('#mobile-edit').val())
		$.ajax({
			type: 'post',
			url: '/admin/customer_edit/' + id,
			data: data,
			processData: false,
			contentType: false,
			success: function (response){
				toastr.success('Update customer success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')
					$('#customerTable').DataTable().ajax.reload();
				},800);
			},
			error: function(data, textStatus, jqXHR) {
	           	if (data.responseJSON.errors.name) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-edit" );
	           	}
	           	if (data.responseJSON.errors.email) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.email[0]+"</p>" ).insertAfter( "#email-edit" );
	           	}
	           	if (data.responseJSON.errors.address) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.address[0]+"</p>" ).insertAfter( "#address-edit" );
	           	}
	           	if (data.responseJSON.errors.mobile) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.mobile[0]+"</p>" ).insertAfter( "#mobile-edit" );
	           	}
	           	if (data.responseJSON.errors.gender) {
	           		$( '<p class="error-noti">'+data.responseJSON.errors.gender[0]+"</p>" ).insertAfter( "#gender-edit" );
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
				url: '/admin/customer/' + id,
				success: function (response) {
					// thông báo xoá thành công bằng toastr
					toastr.success('Delete customer success!')
					setTimeout(function () {
						$('#customerTable').DataTable().ajax.reload();
					},800);
				},
				error: function (error) {
				}
			})
			}
		});
	})
})



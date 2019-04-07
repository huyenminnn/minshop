$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function () {

	$('body').on('click','.btn-show', function(){

		$('#modal-show').modal('show')

		var id = $(this).data('id')
		
		$.ajax({
			type: 'get',
			url: '/admin/branch/' + id,     
			// data:
			success: function (response){
				console.log(response)
				$('#id').html(response.id)   
				$('#name').html(response.name)
				$('#address').html(response.address)
				$('#manager').html(response.manager_id)
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
			url: '/admin/branch',
			data: {
				name: $('#name-add').val(),
				address: $('#address-add').val(),
				manager_id: $('#manager-add').val(),
			},
			success: function(data, textStatus, jqXHR) {
				$('#modal-add').modal('hide')
				toastr.success('Add branch success!')
				$('#branchTable').DataTable().ajax.reload();
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
				}
				if (data.responseJSON.errors.address) {
					$( '<p class="error-noti">'+data.responseJSON.errors.address[0]+"</p>" ).insertAfter( "#address-add" );
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

		var id = $(this).data('id')
		$.ajax({
			type: 'get',
			url: '/admin/branch_showedit/' + id,     
			
			success: function (response){
				console.log()
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name) 
				$('#address-edit').val(response.address)
				$('#manager-edit').val(response.manager_id)
			}
		})
	})
	$('#form-edit').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		var id = $('#id-edit').val()
		$.ajax({
			type: 'post',
			url: '/admin/branch_edit/' + id,
			data:{
				id: id,
				name: $('#name-edit').val(),
				address: $('#address-edit').val(),
				manager_id: $('#manager-edit').val(),
			},
			success: function (response){
				toastr.success('Update branch success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')
					$('#branchTable').DataTable().ajax.reload();
				},800);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
				}
				if (data.responseJSON.errors.address) {
					$( '<p class="error-noti">'+data.responseJSON.errors.address[0]+"</p>" ).insertAfter( "#address-add" );
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
					url: '/admin/branch/' + id,
					success: function (response) {
						// thông báo xoá thành công bằng toastr
						toastr.success('Delete branch success!')
						setTimeout(function () {
							$('#branchTable').DataTable().ajax.reload();
						},800);
					},
					error: function (error) {
					}
				})
			}
		});
	})

	
})



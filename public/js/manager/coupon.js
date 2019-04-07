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
			url: '/admin/coupon/' + id,     
			// data:
			success: function (response){
				console.log(response)
				$('#id').html(response.id)   
				$('#name').html(response.name)
				$('#code').html(response.code)
				$('#start-time').html(response.start_time)
				$('#end-time').html(response.end_time)
				if (response.money == 0) {
					$('#discount').text('-'+response.percent+'%')
				}else {
					$('#discount').text('-'+response.money+' VND')
				}
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
			url: '/admin/coupon',
			data: {
				name: $('#name-add').val(),
				start_time: $('#start_time').val(),
				end_time: $('#end_time').val(),
				money: $('#money_add').val(),
				percent: $('#percent_add').val(),
				code: $('#code_add').val(),
			},
			success: function(data, textStatus, jqXHR) {
				$('#modal-add').modal('hide')
				toastr.success('Add coupon success!')
				$('#couponTable').DataTable().ajax.reload();
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-add" );
				}
				if (data.responseJSON.errors.code) {
					$( '<p class="error-noti">'+data.responseJSON.errors.code[0]+"</p>" ).insertAfter( "#code_add" );
				}
				if (data.responseJSON.errors.start_time) {
					$( '<p class="error-noti">'+data.responseJSON.errors.start_time[0]+"</p>" ).insertAfter( "#start_time" );
				}
				if (data.responseJSON.errors.end_time) {
					$( '<p class="error-noti">'+data.responseJSON.errors.end_time[0]+"</p>" ).insertAfter( "#end_time" );
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
			url: '/admin/coupon/' + id,     
			
			success: function (response){
				console.log()
				$('#id-edit').val(response.id) 
				$('#name-edit').val(response.name) 
				$('#code-edit').val(response.code)
				$('#start-edit').val(response.start_time)
				$('#end-edit').val(response.end_time)
				$('#money-edit').val(response.money)
				$('#percent-edit').val(response.percent)
			}
		})
	})
	$('#form-edit').submit(function(e){
		e.preventDefault()
		$('.error-noti').remove()
		var id = $('#id-edit').val()
		$.ajax({
			type: 'post',
			url: '/admin/coupon_edit/' + id,
			data:{
				id: id,
				name: $('#name-edit').val(),
				code: $('#code-edit').val(),
				money: $('#money-edit').val(),
				percent: $('#percent-edit').val(),
				start_time: $('#start-edit').val(),
				end_time: $('#end-edit').val(),
			},
			success: function (response){
				toastr.success('Update coupon success!')
				setTimeout(function () {
					$('#modal-edit').modal('hide')

					$('#couponTable').DataTable().ajax.reload();
				},800);
			},
			error: function(data, textStatus, jqXHR) {
				if (data.responseJSON.errors.name) {
					$( '<p class="error-noti">'+data.responseJSON.errors.name[0]+"</p>" ).insertAfter( "#name-edit" );
				}
				if (data.responseJSON.errors.code) {
					$( '<p class="error-noti">'+data.responseJSON.errors.code[0]+"</p>" ).insertAfter( "#code-edit" );
				}
				if (data.responseJSON.errors.start_time) {
					$( '<p class="error-noti">'+data.responseJSON.errors.start_time[0]+"</p>" ).insertAfter( "#start-edit" );
				}
				if (data.responseJSON.errors.end_time) {
					$( '<p class="error-noti">'+data.responseJSON.errors.end_time[0]+"</p>" ).insertAfter( "#end-edit" );
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
					url: '/admin/coupon/' + id,
					success: function (response) {
						// thông báo xoá thành công bằng toastr
						toastr.success('Delete coupon success!')
						setTimeout(function () {
							$('#couponTable').DataTable().ajax.reload();
						},800);
					},
					error: function (error) {
					}
				})
			}
		});
	})

	
})



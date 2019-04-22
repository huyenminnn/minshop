$(document).ready(function () {
	$('body').on('click','.btn-conf', function(){
		var id = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/admin/confirmOrder/' + id,     
			// data:
			success: function (data, textStatus, jqXHR){
				toastr.success('Success!')
	        	$('#orderTable').DataTable().ajax.reload();
			}
		})
	})

	$('body').on('click','.btn-deli', function(){
		var id = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/admin/deliveryOrder/' + id,     
			// data:
			success: function (data, textStatus, jqXHR){
				toastr.success('Success!')
	        	$('#orderTable').DataTable().ajax.reload();
			}
		})
	})

	$('body').on('click','.btn-completed', function(){
		var id = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/admin/completeOrder/' + id,     
			// data:
			success: function (data, textStatus, jqXHR){
				toastr.success('Success!')
	        	$('#orderTable').DataTable().ajax.reload();
			}
		})
	})

	$('body').on('click','.btn-delete', function(){
		var id = $(this).data('id')
		$('.modal-delete').modal('show')
		$('#order_id').val(id)
	})

	$('.modal-delete').submit(function(e){
		e.preventDefault()
		var id = $('#order_id').val()
		$.ajax({
			type: 'post',
			url: '/admin/deleteOrder/' + id,
			data: {
				reason: tinymce.get('reject').getContent(),
			},
			success: function (response){
				toastr.success('Success!')
				setTimeout(function () {
					$('.modal-delete').modal('hide')
					$('#orderTable').DataTable().ajax.reload();
				},800);
			},
		})
	})
})
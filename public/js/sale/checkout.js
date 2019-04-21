$(document).ready(function(){
	$.ajax({
			type: 'get',
			url: '/cart/total',   
			success: function (response){
				$('#subtotal').html(response[0]+ 'VND')
				$('#tax').html(response[1]+ 'VND')
				$('#total').html(response[2]+ 'VND')
			}
		})
	$('#checkoutTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/cart/getData',
			columns: [
			{ data: 'name', name: 'name' },
			{ data: 'thumbnail', name: 'thumbnail' },
			{ data: 'options.size', name: 'option.size' },
			{ data: 'options.color', name: 'option.color' },
			{ data: 'qty', name: 'qty' },
			{ data: 'price', name: 'price' },
			{ data: 'subtotal', name: 'subtotal' },
			{ data: 'action', name: 'action' }
			],
    });

    $('body').on('click','.btn-delete',function(){
		var rowId = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/cart/delete-product/'+rowId,   
			success: function (data, textStatus, jqXHR){
				$('#checkoutTable').DataTable().ajax.reload(null,false);
				$('#subtotal').html(data[0]+ ' VND')
				$('#tax').html(data[1]+ ' VND')
				$('#total').html(data[2]+ ' VND')
			}
		})
	})

	$('body').on('click','.minus',function(){
		var rowId = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/cart/minus-product/'+rowId,   
			success: function (data, textStatus, jqXHR){
				$('#checkoutTable').DataTable().ajax.reload(null,false);
				$('#subtotal').html(data[0]+ ' VND')
				$('#tax').html(data[1]+ ' VND')
				$('#total').html(data[2]+ ' VND')
			}
		})
	})

	$('body').on('click','.plus',function(){
		var rowId = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/cart/plus-product/'+rowId,   
			success: function (data, textStatus, jqXHR){
				if (data.data) {
					toastr.warning('This is max quantity!')
				} else{
					$('#checkoutTable').DataTable().ajax.reload(null,false);
					$('#subtotal').html(data[0]+ ' VND')
					$('#tax').html(data[1]+ ' VND')
					$('#total').html(data[2]+ ' VND')
				}
			}
		})
	})

	$('#form-payment').submit(function(e){
		e.preventDefault()
		$.ajax({
			type: "post",
			url: '/orderOnline',
			data: {
				name: $('#customer_name').val(),
				mobile: $('#customer_mobile').val(),
				address: $('#address').val(),
				note: $('#note').val(),
			},
			success: function(data, textStatus, jqXHR) {
			},
		});
	})
})
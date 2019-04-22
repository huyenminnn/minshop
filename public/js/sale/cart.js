$(document).ready(function(){
	$('.add-to-cart').click(function(){
		var id = $(this).data('id')
		
		$.ajax({
			type: 'get',
			url: '/cart/show/' + id,
			success: function(response){
				if (response.data == false) {
					toastr.success('This product sold out!')
				} else{
					$('.modal-add-to-cart').modal('show')
					$('#slide').children().remove()
					$('#sizes').children().remove()
					$('#colors').children().remove()
					$('#slide').append(
						`<li data-thumb="/storage/`+response.product.thumbnail+`">
						<div class="thumb-image"> <img src="/storage/`+response.product.thumbnail+`" data-imagezoom="true" class="img img-fluid img-thumbnail" alt=" "> </div>
						</li>`
						);					
					jQuery.each( response.sizes, function( key, val ) {
						$('#sizes').append(
							`<option value="`+val.id+`">`+val.value+`</option>`
							);					
					});
					jQuery.each( response.colors, function( key, val ) {
						$('#colors').append(
							`<option value="`+val+`">`+val+`</option>`
							);					
					});		
					$('#product-id').val(response.product.id)
					$('#name-product').html(response.product.name)
					$('.item_price').html(response.product.price+' đ')

					var product_detail = response.products[0]
					$('#colors').val(product_detail.color_id)
					$('#sizes').val(product_detail.size)
					$('#quantity-product').html(product_detail.quantity)
					$('#quantity').val(1)
					$('#submit-cart').text('Add to Cart')
					$('#product-detail').val(product_detail.id)
					$('#sizes,#colors').change(function(){
						jQuery.each( response.products, function( key, val ) {
							if (val.color_id == $('#colors').val() && val.size == $('#sizes').val()) {
								product_detail = val;
								$('#quantity-product').html(val.quantity);
								$('#quantity').val(1)
								$('#submit-cart').text('Add to Cart')
								$('#product-detail').val(val.id)
								return false
							} else {
								product_detail.quantity = 0
								$('#quantity-product').html(0);
								$('#quantity').val(0)
								$('#submit-cart').text('Close')
								$('#product-detail').val('')
							}
						})				
					})
					
					if (product_detail.quantity == 0) {
						$('#submit-cart').text('Close')
					}
					$('#quantity').keyup(function(){
						if ($(this).val() > product_detail.quantity) {
							$(this).val(product_detail.quantity)
						}
						
						if ($(this).val() < 0) {
							$(this).val(1)
						}
					})
				}
			},
			error: function(data, textStatus, jqXHR){
				$('.modal-add-to-cart').modal('hide')
				toastr.success('This product sold out!')
			}
		})
	})

	$('#form-choose-product').submit(function(e){
		e.preventDefault()
		if ($('#submit-cart').text() == 'Close') {
			$('.modal-add-to-cart').modal('hide')
		}else{
			var id = $('#product-detail').val()
			$.ajax({
				type: "post",
				url: '/cart/add/'+id,
				data: {
					product_id: $('#product-id').val(),
					quantity: $('#quantity').val(),
					product_detail: id,
				},
				success: function(data, textStatus, jqXHR) {

					$('.modal-add-to-cart').modal('hide')
					toastr.success('Add to cart success!')
				},
			});
		}
		
	})

	$('body').on('click','.btn-delete',function(){
		var rowId = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/cart/delete-product/'+rowId,   
			success: function (data, textStatus, jqXHR){
				$('#cartTable').DataTable().ajax.reload(null,false);
				$('#subtotal').html(data[0]+ 'VND')
				$('#tax').html(data[1]+ 'VND')
				$('#total').html(data[2]+ 'VND')
			}
		})
	})

	$('body').on('click','.minus',function(){
		var rowId = $(this).data('id')
		$.ajax({
			type: 'post',
			url: '/cart/minus-product/'+rowId,   
			success: function (data, textStatus, jqXHR){
				$('#cartTable').DataTable().ajax.reload(null,false);
				$('#subtotal').html(data[0]+ 'VND')
				$('#tax').html(data[1]+ 'VND')
				$('#total').html(data[2]+ 'VND')
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
					$('#cartTable').DataTable().ajax.reload(null,false);
					$('#subtotal').html(data[0]+ 'VND')
					$('#tax').html(data[1]+ 'VND')
					$('#total').html(data[2]+ 'VND')
				}
			}
		})
	})
})
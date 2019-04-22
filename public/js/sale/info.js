$(document).ready(function(){
	var id = $('#product_id').val()
	changeQuantity()

	$('#sizes,#colors').change(function(){
		changeQuantity()
	})

	$('#form-add-to-cart').submit(function(e){
		e.preventDefault()
			var id = $('#product-detail').val()
			$.ajax({
				type: "post",
				url: '/cart/add/'+ $('#detail').val(),
				data: {
					product_id: $('#product_id').val(),
					quantity: $('#quantity_prod').val(),
					product_detail: $('#detail').val(),
				},
				success: function(data, textStatus, jqXHR) {
					
						window.location.replace('/')
					
				},
			});
		
	})

	function changeQuantity(){
		$.ajax({
			type: 'post',
			url: '/getQuantity/'+id,
			data:{
				color: $('#colors').val(),
				size: $('#sizes').val(),
			},
			success: function(data, textStatus, jqXHR){
				console.log(data)
				if (data.data==0) {
					$('#quantity-product').html(0)
					$('#quantity').val(0) 			
					$('#quantity_prod').val(0) 			
					$('#submit-cart').parent().parent().remove() 			

				} else {
					$('#quantity-product').html(data.data)
					$('#quantity').val(data.data)
					$('#submit-cart').text('Add to Cart')
					$('#detail').val(data.detail) 			
				}

				$('#quantity_prod').keyup(function(){
					if ($(this).val() > data.data) {
						$(this).val(data.data)
					}
					if ($(this).val() < 0) {
						$(this).val(1)
					}
				})

			}
		})
	}
})
$(document).ready(function(){
	$('.btn-show').click(function(){
		var id = $(this).data('id')
		$('.modal-show').modal('show')
		$.ajax({
			type: 'get',
			url: '/detailOrder/'+id,
			success: function(response){
				jQuery.each( response, function( key, val ) {
					$('.table-content').append(`
						<tr>
							<td>`+val.name+`</td>
							<td><img src="/storage/`+val.img+`" class="img img-thumbnail"></td>
							<td>`+val.size+`</td>
							<td>`+val.color+`</td>
							<td>`+val.quantity+`</td>
							<td>`+val.price+`</td>
							<td>`+val.total+`</td>
						</tr>`)				
				});		
			}
		})

	})
})
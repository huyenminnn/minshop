$(document).ready(function(){
	$('#form-check').submit(function(e){
		e.preventDefault(e)
		var start = $('#start_time').val()
		var end = $("#end_time").val()
		console.log(start)
		$.ajax({
			type: 'post',
			url: '/admin/getTime',
			data: {
				start: start,
				end: end,
			},
			success: function(data){
				var i = 0;
				jQuery.each( data, function( key, val ) {
					if (i<5) {
						$('#content').append(`
						<tr>
						<td>`+val.product.name+`</td>
						<td><img src="/storage/`+val.product.thumbnail+`" class="img img-thumbnail"></td>
						<td>`+val.product.brand+`</td>
						<td>`+val.product.price+`</td>
						<td>`+val.quantity+`</td>
						</tr>
					`)
						i++   
					}
									
				});
				
			}
		})
	})
})
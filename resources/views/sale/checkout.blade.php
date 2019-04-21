@extends('sale.master')
@section('banner')
<!-- banner -->
<div class="banner_inner">
	<div class="services-breadcrumb">
		<div class="inner_breadcrumb">

			<ul class="short">
				<li>
					<a href="index.html">Home</a>
					<i>|</i>
				</li>
				<li>Checkout </li>
			</ul>
		</div>
	</div>
</div>
@endsection
@section('content')
<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
	<div class="container">
		<div class="inner-sec-shop px-lg-4 px-3">
			<h3 class="tittle-w3layouts my-lg-4 mt-3">Checkout </h3>
			<div class="checkout-right">
				<h4>Your shopping cart contains:
					<span>{{ Cart::count() }} products.</span>
				</h4>
				<table class="timetable_sub" id="checkoutTable">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Product</th>
							<th>Size</th>
							<th>Color</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Subtotal</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="checkout-left row">

				<div class="col-md-8 address_form">
					<h4>Add a new Details</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form" id="form-payment">
						@csrf
						<input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->id() }}">
						<section class="creditly-wrapper wrapper">
							<div class="information-wrapper">
								<div class="first-row form-group">
									<div class="controls">
										<label class="control-label">Name: </label>
										<input class="billing-address-name form-control" type="text" placeholder="Full name" value="{{ Auth::guard('customer')->user()->name }}" name="customer_name" id="customer_name">
									</div>

									<div class="card_number_grids">
										<div class="card_number_grid_left">
											<div class="controls">
												<label class="control-label">Mobile number:</label>
												<input class="form-control" type="text" placeholder="Mobile number" value="{{ Auth::guard('customer')->user()->mobile }}" name="customer_mobile" id="customer_mobile">
											</div>
										</div>
										{{-- <div class="card_number_grid_right">
											<div class="controls">
												<label class="control-label">Landmark: </label>
												<input class="form-control" type="text" placeholder="Landmark">
											</div>
										</div> --}}
										<div class="clear"> </div>
									</div>
									<div class="controls">
										<label class="control-label">Address: </label>
										<input class="form-control" type="text" placeholder="Town/City" value="{{ Auth::guard('customer')->user()->address }}" name="address" id="address">
									</div>
									<div class="controls">
										<label class="control-label">Note: </label>
										<input class="form-control" type="text" placeholder="Note" value="" name="note" id="note">
									</div>
									{{-- <div class="controls">
										<label class="control-label">Address type: </label>
										<select class="form-control option-w3ls">
											<option>Office</option>
											<option>Home</option>
											<option>Commercial</option>

										</select>
									</div> --}}
								</div>
								<button class="submit check_out">Delivery to this Address</button>
							</div>
						</section>
					</form>
				</div>

				<div class="col-md-4 checkout-left-basket">
					<ul>
						<li>Subtotal
							<i>-</i>
							<span id="subtotal"></span>
						</li>
						<li>Tax
							<i>-</i>
							<span id="tax"></span>
						</li>
						<li style="font-weight: bold; font-size: 20px;"><h4>Total						
							<span id="total"></span></h4>
						</li>
					</ul>
				</div>

				<div class="clearfix"> </div>

			</div>

		</div>

	</div>
</section>
@endsection
@section('script')
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!-- newsletter modal -->
<!--search jQuery-->
<script src="{{ asset('sale_assets/js/modernizr-2.6.2.min.js') }}"></script>
<script src="{{ asset('sale_assets/js/classie-search.js') }}"></script>
<script src="{{ asset('sale_assets/js/demo1-search.js') }}"></script>
<!--//search jQuery-->
<!-- cart-js -->
<script src="{{ asset('sale_assets/js/minicart.js') }}"></script>
<script>
	googles.render();

	googles.cart.on('googles_checkout', function (evt) {
		var items, len, i;

		if (this.subtotal() > 0) {
			items = this.items();

			for (i = 0, len = items.length; i < len; i++) {}
		}
});
</script>
<!-- //cart-js -->
<script>
	$(document).ready(function () {
		$(".button-log a").click(function () {
			$(".overlay-login").fadeToggle(200);
			$(this).toggleClass('btn-open').toggleClass('btn-close');
		});
	});
	$('.overlay-close1').on('click', function () {
		$(".overlay-login").fadeToggle(200);
		$(".button-log a").toggleClass('btn-open').toggleClass('btn-close');
		open = false;
	});
</script>
<!-- carousel -->
<!-- easy-responsive-tabs -->
<script src="{{ asset('sale_assets/js/easy-responsive-tabs.js') }}"></script>
<script>
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				closed: 'accordion', // Start closed if in accordion view
				activate: function (event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
		$('#verticalTab').easyResponsiveTabs({
			type: 'vertical',
			width: 'auto',
			fit: true
		});
	});
</script>
<!--quantity-->
<script>
	$('.value-plus').on('click', function () {
		var divUpd = $(this).parent().find('.value'),
		newVal = parseInt(divUpd.text(), 10) + 1;
		divUpd.text(newVal);
	});

	$('.value-minus').on('click', function () {
		var divUpd = $(this).parent().find('.value'),
		newVal = parseInt(divUpd.text(), 10) - 1;
		if (newVal >= 1) divUpd.text(newVal);
	});
</script>
<!--quantity-->
<!--close-->
<script>
	$(document).ready(function (c) {
		$('.close1').on('click', function (c) {
			$('.rem1').fadeOut('slow', function (c) {
				$('.rem1').remove();
			});
		});
	});
</script>
<script>
	$(document).ready(function (c) {
		$('.close2').on('click', function (c) {
			$('.rem2').fadeOut('slow', function (c) {
				$('.rem2').remove();
			});
		});
	});
</script>
<script>
	$(document).ready(function (c) {
		$('.close3').on('click', function (c) {
			$('.rem3').fadeOut('slow', function (c) {
				$('.rem3').remove();
			});
		});
	});
</script>
<!--//close-->

<!-- dropdown nav -->
<script>
	$(document).ready(function () {
		$(".dropdown").hover(
			function () {
				$('.dropdown-menu', this).stop(true, true).slideDown("fast");
				$(this).toggleClass('open');
			},
			function () {
				$('.dropdown-menu', this).stop(true, true).slideUp("fast");
				$(this).toggleClass('open');
			}
			);
	});
</script>
<!-- //dropdown nav -->
<script src="{{ asset('sale_assets/js/move-top.js') }}"></script>
<script src="{{ asset('sale_assets/js/easing.js') }}"></script>
<script>
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event) {
			event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 900);
		});
	});
</script>
<script>
	$(document).ready(function() {
            /*
            						var defaults = {
            							  containerID: 'toTop', // fading element id
            							containerHoverID: 'toTopHover', // fading element hover id
            							scrollSpeed: 1200,
            							easingType: 'linear' 
            						 };
            						 */

            						 $().UItoTop({
            						 	easingType: 'easeOutQuart'
            						 });

            						});
            					</script>
            					<!--// end-smoth-scrolling -->
            					<script src="{{ asset('sale_assets/js/bootstrap.js') }}"></script>
            					<script type="text/javascript" src="js/sale/checkout.js"></script>
            					@endsection
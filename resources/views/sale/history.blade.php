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
			<h3 class="tittle-w3layouts my-lg-4 mt-3">Payment </h3>
			<!--/tabs-->
			<div class="responsive_tabs">
				<div id="horizontalTab">
					<ul class="resp-tabs-list">
						<li>Not Confirm</li>
						<li>Comfirmed</li>
						<li>Delivering</li>
						<li>Complete</li>
					</ul>
					<div class="resp-tabs-container">
						<!--/tab_one-->
						<div class="tab1">
							<table class="timetable_sub">
								<thead>
									<tr>
										<th>Order Code</th>
										<th>Total</th>
										<th>Address</th>
										<th>Mobile</th>
										<th>Delivery Unit</th>
										<th>Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($notconfirmed as $order)
									<tr>
										<td>{{ $order->order_code }}</td>
										<td>{{ $order->total }}</td>
										<td>{{ $order->address }}</td>
										<td>{{ $order->customer_mobile }}</td>
										<td>{{ $order->delivery_unit }}</td>
										<td>{{ $order->created_at->format('H:i:s | d/m/Y') }}</td>
										<td><button type="button" class="btn btn-success btn-show" data-id="{{ $order->id }}">Detail</button></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!--//tab_one-->
						<div class="tab2">
							<table class="timetable_sub">
								<thead>
									<tr>
										<th>Order Code</th>
										<th>Total</th>
										<th>Address</th>
										<th>Mobile</th>
										<th>Delivery Unit</th>
										<th>Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($confirmed as $order)
									<tr>
										<td>{{ $order->order_code }}</td>
										<td>{{ $order->total }}</td>
										<td>{{ $order->address }}</td>
										<td>{{ $order->customer_mobile }}</td>
										<td>{{ $order->delivery_unit }}</td>
										<td>{{ $order->created_at->format('H:i:s | d/m/Y') }}</td>
										<td><button type="button" class="btn btn-success btn-show" data-id="{{ $order->id }}">Detail</button></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="tab3">
							<table class="timetable_sub">
								<thead>
									<tr>
										<th>Order Code</th>
										<th>Total</th>
										<th>Address</th>
										<th>Mobile</th>
										<th>Delivery Unit</th>
										<th>Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($delivering as $order)
									<tr>
										<td>{{ $order->order_code }}</td>
										<td>{{ $order->total }}</td>
										<td>{{ $order->address }}</td>
										<td>{{ $order->customer_mobile }}</td>
										<td>{{ $order->delivery_unit }}</td>
										<td>{{ $order->created_at->format('H:i:s | d/m/Y') }}</td>
										<td><button type="button" class="btn btn-success btn-show" data-id="{{ $order->id }}">Detail</button></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="tab4">
							<table class="timetable_sub">
								<thead>
									<tr>
										<th>Order Code</th>
										<th>Total</th>
										<th>Address</th>
										<th>Mobile</th>
										<th>Delivery Unit</th>
										<th>Time Complete</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($delivering as $order)
									<tr>
										<td>{{ $order->order_code }}</td>
										<td>{{ $order->total }}</td>
										<td>{{ $order->address }}</td>
										<td>{{ $order->customer_mobile }}</td>
										<td>{{ $order->delivery_unit }}</td>
										<td>{{ $order->updated_at->format('H:i:s | d/m/Y') }}</td>
										<td><button type="button" class="btn btn-success btn-show" data-id="{{ $order->id }}">Detail</button></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--//tabs-->
			</div>

		</div>
		<!-- //payment -->
	</div>
	{{-- Modal --}}
<div class="modal fade modal-show">
	<div class="modal-dialog" style="width: 80% !important; max-width: 1000px !important">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Order</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="modal-body text-center p-5 mw-100">
				<table class="table table-bordered table-striped nowrap" style="width: 100%">
					<thead>
						<tr>
							<th>Product</th>
							<th>Image</th>
							<th>Size</th>
							<th>Color</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody class="table-content">
						
					</tbody>
				</table>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Close</button>

			</div>
		</div>

	</div>
</div>
</section>
@endsection
@section('script')
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

<!-- credit-card -->
<script type="text/javascript" src="{{ asset('sale_assets/js/creditly.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sale_assets/css/creditly.css') }}" type="text/css" media="all" />

<script type="text/javascript">
	$(function () {
		var creditly = Creditly.initialize(
			'.creditly-wrapper .expiration-month-and-year',
			'.creditly-wrapper .credit-card-number',
			'.creditly-wrapper .security-code',
			'.creditly-wrapper .card-type');

		$(".creditly-card-form .submit").click(function (e) {
			e.preventDefault();
			var output = creditly.validate();
			if (output) {
		// Your validated credit card output
		console.log(output);
	}
});
	});
</script>
<!-- //credit-card -->
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
		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<!--// end-smoth-scrolling -->


<!-- //smooth-scrolling-of-move-up -->
<script src="{{ asset('sale_assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="js/sale/history.js"></script>
@endsection
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
				<li>Single Page</li>
			</ul>
		</div>
	</div>

</div>
@endsection
@section('content')
<!--/shop-->
<section class="banner-bottom-wthreelayouts py-lg-5 py-3">
	<div class="container">
		<div class="inner-sec-shop pt-lg-4 pt-3">
			<div class="row">
				<div class="col-lg-4 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider1">

							<ul class="slides">
								@foreach($images as $image)
								<li data-thumb="/storage/{{ $image->image }}">
									<div class="thumb-image"> <img src="/storage/{{ $image->image }}" data-imagezoom="true" class="img-fluid" alt=" "> </div>
								</li>
								@endforeach
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-8 single-right-left simpleCart_shelfItem">
					<form method="post" role="form" enctype="multipart/form-data" id="form-add-to-cart">
						<input type="hidden" name="product_id" value="{{ $product->id }}" id="product_id">
						<input type="hidden" name="detail_product" id="detail">
						<input type="hidden" name="quantity" id="quantity">
						<h3>{{ $product->name }}</h3>
						@if(!$data)
						<span>(This product sold out!)</span>
						@endif

						<p><span class="item_price">{{ $product->discount_price }}</span>
							<del>{{ $product->price }}</del>
						</p>
						<div class="rating1">
							<ul class="stars">
								<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="color-quality row" style="margin-bottom: 20px;">
							<div class="color-quality-right col-lg-6">
								<h5>Size :</h5>
								<select id="sizes" class="frm-field required sect" name="size">	
									@foreach($sizes as $size)
									<option value="{{ $size->id }}">{{$size->value }}</option>
									@endforeach
								</select>
							</div>
							<div class="color-quality-right col-lg-6">
								<h5>Color :</h5>
								<select id="colors" class="frm-field required sect" name="color">
									@foreach($colors as $color)
									<option value="{{ $color }}">{{$color }}</option>
									@endforeach							
								</select>
							</div>

						</div>
						<div class="color-quality-right">
							<label><h5>Quantity :</h5></label> 
							<input type="number" name="quantity" value="1" id="quantity_prod">(<span id="quantity-product" style="font-weight: bold;"></span> products left)

						</div>
						@if(Auth::guard('customer')->check())
						<div class="occasion-cart">
							<div class="googles single-item singlepage">
								<button type="submit" class="googles-cart pgoogles-cart" id="submit-cart">
									
								</button>
							</div>
						</div>
						@endif
						<ul class="footer-social text-left mt-lg-4 mt-3">
							<li>Share On : </li>
							<li class="mx-2">
								<a href="#">
									<span class="fab fa-facebook-f"></span>
								</a>
							</li>
							<li class="mx-2">
								<a href="#">
									<span class="fab fa-twitter"></span>
								</a>
							</li>
							<li class="mx-2">
								<a href="#">
									<span class="fab fa-google-plus-g"></span>
								</a>
							</li>
							<li class="mx-2">
								<a href="#">
									<span class="fab fa-linkedin-in"></span>
								</a>
							</li>
							<li class="mx-2">
								<a href="#">
									<span class="fas fa-rss"></span>
								</a>
							</li>

						</ul>
					</form>
				</div>

				<div class="clearfix"> </div>
				<!--/tabs-->
				<div class="responsive_tabs">
					<div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li>Description</li>
							<li>Reviews</li>
							<li>Information</li>
						</ul>
						<div class="resp-tabs-container">
							<!--/tab_one-->
							<div class="tab1">

								<div class="single_page">
									{!! $product->product_info !!}
								</div>
							</div>
							<!--//tab_one-->
							<div class="tab2">

								<div class="single_page">
									<div class="bootstrap-tab-text-grids">
										<div class="bootstrap-tab-text-grid">
											<div class="bootstrap-tab-text-grid-left">
												<img src="{{ asset('sale_assets/images/team1.jpg') }}" alt=" " class="img-fluid">
											</div>
											<div class="bootstrap-tab-text-grid-right">
												<ul>
													<li><a href="#">Admin</a></li>
													<li><a href="#"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a></li>
												</ul>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget.Ut enim ad minima veniam,
													quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis
												autem vel eum iure reprehenderit.</p>
											</div>
											<div class="clearfix"> </div>
										</div>
										<div class="add-review">
											<h4>add a review</h4>
											<form action="#" method="post">
												<input class="form-control" type="text" name="Name" placeholder="Enter your email..." required="">
												<input class="form-control" type="email" name="Email" placeholder="Enter your email..." required="">
												<textarea name="Message" required=""></textarea>
												<input type="submit" value="SEND">
											</form>
										</div>
									</div>

								</div>
							</div>
							<div class="tab3">

								<div class="single_page">
									<h6>Irayz Butterfly Sunglasses  (Black)</h6>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget nisl ullamcorper, molestie
										blandit ipsum auctor. Mauris volutpat augue dolor.Consectetur adipisicing elit, sed do eiusmod tempor incididunt
										ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. labore et dolore
									magna aliqua.</p>
									<p class="para">Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget nisl ullamcorper, molestie
										blandit ipsum auctor. Mauris volutpat augue dolor.Consectetur adipisicing elit, sed do eiusmod tempor incididunt
										ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. labore et dolore
									magna aliqua.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--//tabs-->

			</div>
		</div>
	</div>

</section>
@endsection
@section('script')
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
<!-- price range (top products) -->
<script src="{{ asset('sale_assets/js/jquery-ui.js') }}"></script>
<script>
			//<![CDATA[ 
			$(window).load(function () {
				$("#slider-range").slider({
					range: true,
					min: 0,
					max: 9000,
					values: [50, 6000],
					slide: function (event, ui) {
						$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
					}
				});
				$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

			}); //]]>
		</script>
		<!-- //price range (top products) -->

		<script src="{{ asset('sale_assets/js/owl.carousel.js') }}"></script>
		<script>
			$(document).ready(function () {
				$('.owl-carousel').owlCarousel({
					loop: true,
					margin: 10,
					responsiveClass: true,
					responsive: {
						0: {
							items: 1,
							nav: true
						},
						600: {
							items: 2,
							nav: false
						},
						900: {
							items: 3,
							nav: false
						},
						1000: {
							items: 4,
							nav: true,
							loop: false,
							margin: 20
						}
					}
				})
			})
		</script>

		<!-- //end-smooth-scrolling -->

		<!-- single -->
		<script src="{{ asset('sale_assets/js/imagezoom.js') }}"></script>
		<!-- single -->
		<!-- script for responsive tabs -->
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
		<!-- FlexSlider -->
		<script src="{{ asset('sale_assets/js/jquery.flexslider.js') }}"></script>
		<script>
			// Can also be used with $(document).ready()
			$(window).load(function () {
				$('.flexslider1').flexslider({
					animation: "slide",
					controlNav: "thumbnails"
				});
			});
		</script>
		<!-- //FlexSlider-->

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


		<script src="{{ asset('sale_assets/js/bootstrap.js') }}"></script>
		<script type="text/javascript" src="/js/sale/info.js"></script>
		@endsection

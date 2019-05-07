<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Min Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Goggles a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="{{ asset('sale_assets/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('sale_assets/css/login_overlay.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('sale_assets/css/style6.css') }}" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="{{ asset('sale_assets/css/shop.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('sale_assets/css/owl.carousel.css') }}" type="text/css" media="all">
	<link rel="stylesheet" href="{{ asset('sale_assets/css/owl.theme.css') }}" type="text/css" media="all">
	<link rel="stylesheet" href="{{ asset('sale_assets/css/flexslider.css') }}" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="{{ asset('sale_assets/css/jquery-ui1.css') }}">
	<link href="{{ asset('sale_assets/css/style.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('sale_assets/css/fontawesome-all.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('sale_assets/css/checkout.css') }}">
	<link href="{{ asset('sale_assets/css/easy-responsive-tabs.css') }}" rel='stylesheet' type='text/css' />
	<link href="///fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
	<link href="///fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
	<link href="{{ asset('sale_assets/css/simplyCountdown.css') }}" rel='stylesheet' type='text/css' />
	{{-- Toastr --}}
  	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


</head>

<body>
	<div class="banner-top container-fluid" id="home">
		<!-- header -->
		<header>
			<div class="row">
				<div class="col-md-3 top-info text-left mt-lg-4">
					<h6>Need Help</h6>
					<ul>
						<li><i class="fas fa-phone"></i> Call</li>
						<li class="number-phone mt-3">12345678099</li>
					</ul>
				</div>
				<div class="col-md-6 logo-w3layouts text-center">
					<h1 class="logo-w3layouts">
						<a class="navbar-brand" href="index.html">
						MIN SHOP </a>
					</h1>
				</div>

				<div class="col-md-3 top-info-cart text-right mt-lg-4">
					<ul class="cart-inner-info">
						<li class="button-log">
							<a class="btn-open" href="#">
								@if(!Auth::guard('customer')->check())
								<span>Đăng nhập</span>
								@else
								<span class="fa fa-user" aria-hidden="true"> {{ Auth::guard('customer')->user()->name }}</span>
								@endif
							</a>
						</li>
						<li class="galssescart galssescart2 cart cart box_1">
							<button class="top_googles_cart" type="submit" name="submit" id="checkout-cart">
								Giỏ hàng
								<i class="fas fa-cart-arrow-down"></i>
							</button>
						</li>
					</ul>
					
					<!---->
					<div class="overlay-login text-left">
						<button type="button" class="overlay-close1">
							<i class="fa fa-times" aria-hidden="true"></i>
						</button>
						<div class="wrap">
							@if(!Auth::guard('customer')->check())

							<h5 class="text-center mb-4">Login Now</h5>
							<div class="login p-5 bg-dark mx-auto mw-100">
								<form action="" method="post" id="form-login">
									@csrf
									<div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
										<label class="mb-2">Email address</label>
										<input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autofocus>
										<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
									</div>
									<div class="form-group"  data-validate="Password is required">
										<label class="mb-2">Password</label>
										<input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputPassword1" name="password" placeholder="" required="">
									</div>
									<div class="form-check mb-2">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">Check me out</label>
									</div>
									<button type="submit" class="btn btn-primary submit mb-4">Sign In</button>

								</form>
								<a href="/register">Đăng kí</a>
							</div>
							<!---->
							@else
							<ul class="mega-menu ">
								<li><a href="/history" class="text-light"> History Orders</a></li>
								{{-- <li>
									<a href="#"  class="text-light">
										Setting
									</a>
								</li>
								<li><a href="#"  class="text-light">Help</a></li> --}}
								<li><a href="{{ asset('/logout') }}"  class="text-light" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i>Log Out</a>
									<form id="logout-form" action="{{ asset('/logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</li>
							</ul>
							@endif
							<!---->
						</div>
					</div>
				</div>
			</div>
			<div class="search">
				<div class="mobile-nav-button">
					<button id="trigger-overlay" type="button">
						<i class="fas fa-search"></i>
					</button>
				</div>
				<!-- open/close -->
				<div class="overlay overlay-door">
					<button type="button" class="overlay-close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
					<form action="#" method="post" class="d-flex">
						<input class="form-control" type="search" placeholder="Search here..." required="">
						<button type="submit" class="btn btn-primary submit">
							<i class="fas fa-search"></i>
						</button>
					</form>

				</div>
				<!-- open/close -->
			</div>
			<label class="top-log mx-auto"></label>
			<nav class="navbar navbar-expand-lg navbar-light bg-light top-header mb-2">

				<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					
				</span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav nav-mega mx-auto">
					<li class="nav-item active">
						<a class="nav-link ml-lg-0" href="/">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.facebook.com/quynh.lam.7739">About</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						Features
					</a>
					<ul class="dropdown-menu mega-menu ">
						<li>
							<div class="row">
								<div class="col-md-4 media-list span4 text-left">
									<h5 class="tittle-w3layouts-sub"> Category </h5>
									<ul>
										@foreach($categories as $cate)
										<li class="mt-2">
											<a href="#">{{ $cate->name }}</a>
										</li>
										@endforeach
									</ul>
								</div>
								<div class="col-md-4 media-list span4 text-left">
									<h5 class="tittle-w3layouts-sub"> Category </h5>
									<div class="media-mini mt-3">
										<a href="shop.html">
											<img src="{{ asset('sale_assets/images/g2.jpg') }}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
								<div class="col-md-4 media-list span4 text-left">
									<h5 class="tittle-w3layouts-sub">Tittle goes here </h5>
									<div class="media-mini mt-3">
										<a href="shop.html">
											<img src="{{ asset('sale_assets/images/g3.jpg') }}" class="img-fluid" alt="">
										</a>
									</div>

								</div>
							</div>
							<hr>
						</li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">
					Shop
				</a>
				<ul class="dropdown-menu mega-menu ">
					<li>
						<div class="row">
							<div class="col-md-4 media-list span4 text-left">
								<h5 class="tittle-w3layouts-sub"> Tittle goes here </h5>
								<ul>
									<li class="media-mini mt-3">
										<a href="shop.html">Designer Glasses</a>
									</li>
									<li class="">
										<a href="shop.html"> Ray-Ban</a>
									</li>
									<li>
										<a href="shop.html">Prescription Glasses</a>
									</li>
									<li>
										<a href="shop.html">Rx Sunglasses</a>
									</li>
									<li>
										<a href="shop.html">Contact Lenses</a>
									</li>
									<li>
										<a href="shop.html">Multifocal Glasses</a>
									</li>
									<li>
										<a href="shop.html">Kids Glasses</a>
									</li>
									<li>
										<a href="shop.html">Lightweight Glasses</a>
									</li>
									<li>
										<a href="shop.html">Sports Glasses</a>
									</li>
								</ul>
							</div>
							<div class="col-md-4 media-list span4 text-left">
								<h5 class="tittle-w3layouts-sub"> Tittle goes here </h5>
								<ul>
									<li class="media-mini mt-3">

										<a href="shop.html">Brooks Brothers</a>
									</li>
									<li>
										<a href="shop.html">Persol</a>
									</li>
									<li>
										<a href="shop.html">Polo Ralph Lauren</a>
									</li>
									<li>
										<a href="shop.html">Prada</a>
									</li>
									<li>
										<a href="shop.html">Ray-Ban Jr</a>
									</li>
									<li>
										<a href="shop.html">Sferoflex</a>
									</li>
								</ul>
								<ul class="sub-in text-left">

									<li>
										<a href="shop.html">Polo Ralph Lauren</a>
									</li>
									<li>
										<a href="shop.html">Prada</a>
									</li>
									<li>
										<a href="shop.html">Ray-Ban Jr</a>
									</li>
								</ul>

							</div>
							<div class="col-md-4 media-list span4 text-left">

								<h5 class="tittle-w3layouts-sub-nav">Tittle goes here </h5>
								<div class="media-mini mt-3">
									<a href="shop.html">
										<img src="{{ asset('sale_assets/images/g1.jpg') }}" class="img-fluid" alt="">
									</a>
								</div>

							</div>
						</div>
						<hr>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="https://www.facebook.com/quynh.lam.7739">Contact</a>
			</li>
		</ul>

	</div>
</nav>
</header>
<!-- //header -->

@yield('banner')
</div>
@yield('content')
<!--footer -->
<footer class="py-lg-5 py-3">
	<div class="container-fluid px-lg-5 px-3">
		<div class="row footer-top-w3layouts">
			<div class="col-lg-3 footer-grid-w3ls">
				<div class="footer-title">
					<h3>About Us</h3>
				</div>
				<div class="footer-text">
					<p>Curabitur non nulla sit amet nislinit tempus convallis quis ac lectus. lac inia eget consectetur sed, convallis at
					tellus. Nulla porttitor accumsana tincidunt.</p>
					<ul class="footer-social text-left mt-lg-4 mt-3">

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
						<li class="mx-2">
							<a href="#">
								<span class="fab fa-vk"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 footer-grid-w3ls">
				<div class="footer-title">
					<h3>Get in touch</h3>
				</div>
				<div class="contact-info">
					<h4>Location :</h4>
					<p>Số 2, ngõ Trại Cá, Trương Định, Hai BÀ Trưng, Hà Nội</p>
					<div class="phone">
						<h4>Contact :</h4>
						<p>Phone : +84 963 326 470</p>
						<p>Email :
							<a href="huyenttm.13@gmail.com">huyenttm.13@gmail.com</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 footer-grid-w3ls">
				<div class="footer-title">
					<h3>Quick Links</h3>
				</div>
				<ul class="links">
					<li>
						<a href="index.html">Home</a>
					</li>
					<li>
						<a href="about.html">About</a>
					</li>
					<li>
						<a href="404.html">Error</a>
					</li>
					<li>
						<a href="shop.html">Shop</a>
					</li>
					<li>
						<a href="contact.html">Contact Us</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-3 footer-grid-w3ls">
				<div class="footer-title">
					<h3>Sign up for your offers</h3>
				</div>
				<div class="footer-text">
					<p>By subscribing to our mailing list you will always get latest news and updates from us.</p>
					<form action="#" method="post">
						<input class="form-control" type="email" name="Email" placeholder="Enter your email..." required="">
						<button class="btn1">
							<i class="far fa-envelope" aria-hidden="true"></i>
						</button>
						<div class="clearfix"> </div>
					</form>
				</div>
			</div>
		</div>
		<div class="copyright-w3layouts mt-4">
			<p class="copy-right text-center ">&copy; 2018 Goggles. All Rights Reserved | Design by
				<a href="http://w3layouts.com/"> HuyenMinnn </a>
			</p>
		</div>
	</div>
</footer>
<!-- //footer -->

{{-- Modal --}}
<div class="modal fade modal-cart">
	<div class="modal-dialog" style="width: 80% !important; max-width: 1000px !important">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Your cart</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="modal-body text-center p-5 mw-100">
				<table id="cartTable" class="table table-bordered table-striped nowrap" style="width: 100%">
					<thead>
						<tr>
							<th>Product</th>
							<th>Image</th>
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

			<div class="text-right" style="padding:0px 5% 20px;">
				<h6>Total (Without tax): <span id="subtotal"></span></h6>
				<h6>TAX (10%): <span id="tax"></span></h6>
				<h4 style="color: red;">TOTAL: <span id="total"></span></h4>

			</div>

			<div class="modal-footer" style="padding-right: 5%">
				<a href="{{ asset('/checkout') }}" ><button type="submit" class="btn btn-primary btn-checkout">CHECK OUT</button></a>
			</div>
		</div>

	</div>
</div>
<!--jQuery-->
<script src="{{ asset('sale_assets/js/jquery-2.2.3.min.js') }}"></script>
<!--search jQuery-->
<script src="{{ asset('sale_assets/js/modernizr-2.6.2.min.js') }}"></script>
<script src="{{ asset('sale_assets/js/classie-search.js') }}"></script>
<script src="{{ asset('sale_assets/js/demo1-search.js') }}"></script>
<!--//search jQuery-->
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#checkout-cart').click(function(){
		$('.modal-cart').modal('show')
		$.ajax({
			type: 'get',
			url: '/cart/total',   
			success: function (response){
				$('#subtotal').html(response[0]+ 'VND')
				$('#tax').html(response[1]+ 'VND')
				$('#total').html(response[2]+ 'VND')
			}
		})
		$('#cartTable').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
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
	})
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>

@yield('script')
</body>

</html>
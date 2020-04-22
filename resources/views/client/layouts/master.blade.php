<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Electro Store - @yield('title')</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/>
	<!-- //Meta tag Keywords -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Custom-Files -->
	<link href="assets/client/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="assets/client/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="assets/client/css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="assets/client/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="assets/client/css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<link href="assets/client/css/client.css" rel="stylesheet" type="text/css" media="all" />
	<link href="assets/client/css/navCategory.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->
	<!-- web fonts -->
	<link href="assets/client/css/css.css" rel="stylesheet">
	<link href="assets/client/css/vnFont.css"
	    rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/client/css/easy-responsive-tabs.css">
	<!-- //web fonts -->
	<!-- jquery -->
	<script src="assets/client/js/jquery-2.2.3.min.js"></script>
	<!-- //jquery -->
	<link rel="stylesheet" href="js/dist/jquery.fancybox.min.css" />
</head>

<body>
	<!-- top-header -->
	@include('client.layouts.topheader')
	<!-- Button trigger modal(select-location) -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="select-city">
			<h3>
				<i class="fas fa-map-marker"></i> Please Select Your Location</h3>
			<select class="list_of_cities">
				<optgroup label="Popular Cities">
					<option selected style="display:none;color:#eee;">Select City</option>
					<option>Birmingham</option>
					<option>Anchorage</option>
					<option>Phoenix</option>
					<option>Little Rock</option>
					<option>Los Angeles</option>
					<option>Denver</option>
					<option>Bridgeport</option>
					<option>Wilmington</option>
					<option>Jacksonville</option>
					<option>Atlanta</option>
					<option>Honolulu</option>
					<option>Boise</option>
					<option>Chicago</option>
					<option>Indianapolis</option>
				</optgroup>
			</select>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //shop locator (popup) -->

	<!-- modals -->
	@if($errors->login->any())
	<script type="text/javascript">
		$(document).ready(function() {
			// body...
			$('#exampleModal').modal('show');
		});
	</script>
	@endif
	<!-- log in -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('login')}}" method="post">
						@csrf
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email" required="">
						</div>
						@if($errors->login->has('email'))
						<div class="alert alert-danger">
							{{ $errors->login->first('email') }}
						</div>
						@endif
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password" required="">
						</div>
						@if($errors->login->has('password'))
						<div class="alert alert-danger">
							{{ $errors->login->first('password') }}
						</div>
						@endif
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng nhập">
						</div>
						<div class="right-w3l">
							<a href="login/facebook" class="form-control btn btn-primary" value="">Đăng nhập bằng facebook</a>
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" name="remember" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">Nhớ mật khẩu?</label>
							</div>
						</div>
						<p class="text-center dont-do mt-3">Bạn chưa có tài khoản ?
							<a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">
								Đăng ký</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	@if($errors->register->any())
	<script type="text/javascript">
		$(document).ready(function() {
			// body...
			$('#registerModal').modal('show');
		});
	</script>
	@endif
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('register') }}" method="post">
						@csrf
						<div class="form-group">
							<label class="col-form-label">Tên tài khoản</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="" value="{{ old('name') }}">
						</div>
						@if($errors->register->has('name'))
						<div class="alert alert-danger">
							{{ $errors->register->first('name') }}
						</div>
						@endif
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="" value="{{ old('email') }}">
						</div>
						@if($errors->register->has('email'))
						<div class="alert alert-danger">
							{{ $errors->register->first('email') }}
						</div>
						@endif
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" class="form-control" placeholder=" " name="password" id="password1" required="" value="{{ old('password') }}">
						</div>
						@if($errors->register->has('password'))
						<div class="alert alert-danger">
							{{ $errors->register->first('password') }}
						</div>
						@endif
						<div class="form-group">
							<label class="col-form-label">Confirm Password</label>
							<input type="password" class="form-control" placeholder=" " name="re_password" id="password2" required="" value="{{ old('re_password') }}">
						</div>
						@if($errors->register->has('re_password'))
						<div class="alert alert-danger">
							{{ $errors->register->first('re_password') }}
						</div>
						@endif
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng ký">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->

	<!-- header-bottom-->
	@include('client.layouts.headerbottom')
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->
	@include('client.layouts.menu')
	<!-- //navigation -->

	<!-- banner -->
	@yield('banner')
	<!-- //banner -->

	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			@yield('content')
		</div>
	</div>
	<!-- //top products -->
	<!-- footer -->
	@include('client.layouts.footer')
	<!-- //footer -->
	<!-- copyright -->
	@include('client.layouts.copyright')
	<!-- //copyright -->

	<!-- js-files -->

	<!-- nav smooth scroll -->
	<!-- //nav smooth scroll -->
	<!-- popup modal (for location)-->
	<script src="assets/client/js/jquery.magnific-popup.js"></script>
	<!-- //popup modal (for location)-->

	<!-- cart-js -->
	<script src="assets/client/js/minicart.js"></script>
	<!-- //cart-js -->

	<!-- password-script -->
	<!-- //password-script -->
	
	<!-- scroll seller -->
	<script src="assets/client/js/scroll.js"></script>
	<!-- //scroll seller -->

	<!-- smoothscroll -->
	<<!-- script src="assets/client/js/SmoothScroll.min.js"></script> -->
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="assets/client/js/move-top.js"></script>
	<script src="assets/client/js/easing.js"></script>
	<script src="assets/client/js/sweetalert2.all.min.js"></script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<!-- //smooth-scrolling-of-move-up -->
	<!-- for bootstrap working -->
	<script src="assets/client/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/client/js/client.js"></script>
	<script type="text/javascript" src="assets/client/js/ajax.js"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->
	@if(session()->has('ctSuccess'))
	<script type="text/javascript">
		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: "{{session('ctMessage')}}",
			showConfirmButton: false,
			timer: 1500
		})
	</script>
	@endif
	@if(session()->has('ctErrorrs'))
	<script type="text/javascript">
		Swal.fire({
			position: 'top-end',
			icon: 'error',
			title: "{{session('ctMessage')}}",
			showConfirmButton: false,
			timer: 1500
		})
	</script>
	@endif
</body>

</html>
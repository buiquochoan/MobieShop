<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					<p class="text-white text-lg-left text-center">Offer Zone Top Deals & Discounts
						<i class="fas fa-shopping-cart ml-1"></i>
					</p>
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
						<li class="text-center border-right text-white">
							<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
								<i class="fas fa-map-marker mr-2"></i>Select Location</a>
						</li>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-truck mr-2"></i>Track Order</a>
						</li>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> 001 234 5678
						</li>
						@if(Auth::check())
						<a href="{{ route('logout') }}" class="text-white">
							<li class="text-center border-right">
								<i class="fas fa-sign-in-alt mr-2"></i>{{ Auth::user()->name }}</a>
							</li>
						</a>
						@if(Auth::user()->password === '')
						<div class="modal fade updatePassWord" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Update password</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('register') }}" method="post">
											<div class="form-group">
												<label class="col-form-label">Password</label>
												<input type="password" class="form-control" placeholder=" " name="password" id="password1" required="">
											</div>
											@if($errors->has('password'))
											<div class="alert alert-danger">
												{{ $errors->first('password') }}
											</div>
											@endif
											<div class="form-group">
												<label class="col-form-label">Confirm Password</label>
												<input type="password" class="form-control" placeholder=" " name="re_password" id="password2" required="">
											</div>
											<div class="right-w3l">
												<input type="submit" class="form-control" value="Đăng ký">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endif
						@else
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Log In </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#registerModal" class="text-white">
									<i class="fas fa-sign-out-alt mr-2"></i>Register </a>
						</li>
						@endif
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>
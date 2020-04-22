@extends('client.layouts.master')
@section('title')
	Giỏ hàng
@endsection

@section('content')
	<!-- banner-2 -->
	<div class="page-head_agile_info_w3l">

	</div>
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="/">Trang chủ</a>
						<i>|</i>
					</li>
					<li>Giỏ hàng</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>G</span>iỏ hàng của {{Auth::user()->name}}
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<h4 class="mb-sm-4 mb-3">Bạn có tổng cộng :
					<span>{{ Cart::count() }}</span> sản phẩm
				</h4>
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>STT</th>
								<th>Hình ảnh</th>
								<th>Số lượng</th>
								<th>Sản phẩm</th>
								<th>Đơn giá</th>
								<th>Chỉnh sửa</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$stt = 0; ?>
							@if(!empty($cart))
								@foreach($cart as $key => $val)
								<?php $stt++ ?>
									<tr class="rem1">
										<td class="invert">{{ $stt }}</td>
										<td class="invert-image">
											@if($val->options->img != "")
											<a data-fancybox="gallery" href="img/upload/product/{{ $val->options->img }}">	
												<img style="width: 100px;height: 100px" class="imgProduct" src="img/upload/product/{{ $val->options->img }}" alt="Chưa có ảnh">
											</a>
											@else
											<img style="width: 100px;height: 100px" class="imgProduct" src="assets/client/images/no-image-prod.webp" alt="Chưa có ảnh">
											@endif
										</td>
										<td class="invert">
											<form class="">
												<div class="quantity">
													<div class="form-group">
														<input class="form-control" type="hidden" name="row_id" id="row_id" value="{{ $val->rowId }}">
														<input class="form-control cartQty" type="number" name="qty" id="qty" data-id="{{ $val->rowId }}" value="{{ $val->qty }}">
													</div>
												</div>
											</form>
										</td>
										<td class="invert">{{ $val->name }}</td>
										<td class="invert">{{ $val->price }}</td>
										<td class="invert">
											<div class="rem">
												<div class="close1 btnDeleteCart" data-id="{{ $val->rowId }}"> </div>
											</div>
										</td>
									</tr>
								@endforeach;
							@endif
						</tbody>
					</table>
					<h4 class="mb-sm-4 mb-3" style="margin-top: 15px;text-align: right">Bạn cần thanh toán :
					<span>{{ Cart::total() }}</span> VND
				</h4>
				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<a href="/checkout" class="mb-sm-4 mb-3">Giao hàng đến địa chỉ</a>
					<!-- <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Full Name" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Mobile Number" name="number" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Landmark" name="landmark" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Town/City" name="city" required="">
									</div>
									<div class="controls form-group">
										<select class="option-w3ls">
											<option>Select Address type</option>
											<option>Office</option>
											<option>Home</option>
											<option>Commercial</option>
					
										</select>
									</div>
								</div>
								<button class="submit check_out btn">Delivery to this Address</button>
							</div>
						</div>
					</form> -->
					<div class="checkout-right-basket">
						<a href="payment.html">Chọn phương thức thanh toán
							<span class="far fa-hand-point-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //checkout page -->
@endsection
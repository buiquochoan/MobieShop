@extends('client.layouts.master')
@section('title')
	Thanh toán
@endsection

@section('content')
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
					<li>Đặt hàng</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<br/>
	<div class="row">
		<div class="col-sm-8">
			<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);">
				<div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
					<div class="vertical_post check_box_agile">
						<h5 style="float: left;clear: both;"><i class="fas fa-map-marker-alt"></i> Địa chỉ nhận hàng</h5>
						<a href="#modalAddress" style="float: right;" data-toggle="modal">Thay đổi</a>
						<div style="clear: both;"></div>
						<div class="checkbox">
							<div class="check_box_one cashon_delivery">
								<label class="anim" style="width: 100%">
									<?php if (count($user->customer) > 0){ ?>
										<ul style="list-style: none;">
											<?php foreach ($user->customer as $key => $val): ?>
												<li>
													<input type="radio" name="rdoaddress" value="{{ $val->id }}" style="float: left;margin-top: 8px" {{ $val->active == 1 ? 'checked="checked"' : '' }}>
													<p>{{$user->name}} | {{$val->phone}}</p>
													<p>{{ $val->email }}</p>
													<p>{{ $val->address }}</p>
												</li>
											<?php endforeach ?>
										</ul>
									<?php }else{ ?>
										Bạn chưa thêm địa chỉ nhận hàng
									<?php } ?>
								</label>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);margin-top: 15px">
				<div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
					<div class="vertical_post check_box_agile">
						<h5 style="float: left;clear: both;"><i class="fas fa-dolly"></i> Phương thức vận chuyển</h5>
						<div style="clear: both;"></div>
						<div class="">
							<div class="check_box_one cashon_delivery">
								<div class="anim" style="float: left;width: 100%">
									<div style="float: left;width: 65%">
										<input type="checkbox" checked="checked" class="checkbox" style="">
										<span>
											Chuyển phát tiêu chuẩn
											<p>Dự kiến giao hàng sau 3-4 ngày</p>
										</span>
									</div>
									<div style="float: left;width: 35%;text-align: right;">
										<span>{{ number_format('200000')}} VND</span>
									</div>
								</div>
								<div style="clear: both;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);">
				<div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
					<div class="vertical_post check_box_agile">
						<h5 class="text-center" style=""><i class="fas fa-shopping-cart"></i> Thông tin đơn hàng</h5>
						<div class="checkbox">
							<div class="check_box_one cashon_delivery">
								<label class="anim" style="width: 100%">
									<p style="float: left;width: 60% !important">Tổng tiền</p>
									<p style="float: left;width: 40%;text-align: right;">{{ number_format($price) }}</p>
								</label>
								<label class="anim"  style="width: 100%">
									<p style="float: left;width: 60% !important">Phí vận chuyển</p>
									<p style="float: left;width: 40%;text-align: right;">20,000</p>
								</label>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);margin-top: 15px;">
				<div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
					<div class="vertical_post check_box_agile">	
					<h5 class="text-center" style=""><i class="far fa-sticky-note"></i> Ghi chú</h5>				
						<div class="checkbox">
							<div class="check_box_one cashon_delivery">
								<div class="form-group">
									<textarea class="form-control txtGhiChuThanhToan" placeholder="Bạn có nhắn gì tới shop không?" name="email" required=""></textarea>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);margin-top: 15px;">
				<div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
					<div class="vertical_post check_box_agile">					
						<div class="checkbox">
							<div class="check_box_one cashon_delivery">
								<label class="anim" style="width: 100%">
									<p style="float: left;width: 60% !important">Tổng thanh toán</p>
									<p style="float: left;width: 40%;text-align: right;">
									{{number_format($price + 20000)}}
									<input type="hidden" class="txtTotalMoney" name="txtTotalMoney" value="{{ ($price+20000) }}">
								</p>
								</label>
								<label class="anim"  style="width: 100%;text-align: center;margin-top: 15px;">
									<button type="button" class="btn btn-primary btnPayment">Tiến hành thanh toán</button>
								</label>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalAddress" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Thay đổi địa chỉ giao hàng</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post">
						<div class="form-group">
							<label class="col-form-label">Địa chỉ Email</label>
							<input type="text" class="form-control email" placeholder="Nhập địa chỉ email" name="email" required="" value="{{ empty(Auth::user()->email) ? '' : Auth::user()->email }}">
						</div>
						<div class="alert alert-danger errorEmail">
						</div>
						<div class="form-group">
							<label class="col-form-label">Số điện thoại</label>
							<input type="text" class="form-control phone" placeholder="Nhập số điện thoại" name="phone" required="">
						</div>
						<div class="alert alert-danger errorPhone">
						</div>
						<div class="form-group">
							<label class="col-form-label">Địa chỉ</label>
							<input type="text" class="form-control address" placeholder="Nhập địa chỉ" name="address" required="">
						</div>
						<div class="alert alert-danger errorAddress">
						</div>
						<div class="form-group">
							<input checked="checked" type="checkbox" class="cbActive" placeholder="Nhập địa chỉ" name="cbActive" required="">
							<label class="col-form-label">Dùng địa chỉ này cho các đơn hàng sau</label>
						</div>
						<div class="right-w3l">
							<button type="button" class="btn btn-primary form-control btnAddAddress">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
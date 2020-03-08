@extends('admin.layouts.master')

@section('title')
Thêm loại sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
	</div>
	<div class="row" style="margin: 5px">
		<div class="col-lg-12">

			<form role="form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<fieldset class="form-group">
					<label>Tên sản phẩm</label>
					<input class="form-control" name="name" placeholder="Nhập tên sản phẩm">
					@if($errors->has('name'))
					<div class="alert alert-danger">
						{{ $errors->first('name') }}
					</div>
					@endif
				</fieldset>
				<div class="form-group">
					<label>Trạng thái</label>
					<select name="status" class="form-control">
						<option value="1">Hiển thị</option>
						<option value="0">Không hiển thị</option>
					</select>
				</div>
				<div class="form-group">
					<label>Mô tả</label>
					<textarea name="description" id="description" class="form-control ckeditor" placeholder="Nhập mô tả sản phẩm"></textarea>
				</div>
				<div class="form-group">
					<label>Số lượng</label>
					<input name="quantity" id="quantity" class="form-control" placeholder="Số lượng">
				</div>
				@if($errors->has('quantity'))
				<div class="alert alert-danger">
					{{ $errors->first('quantity') }}
				</div>
				@endif
				<div class="form-group">
					<label>Đơn giá</label>
					<input name="price" id="price" class="form-control" placeholder="Giá">
				</div>
				@if($errors->has('price'))
				<div class="alert alert-danger">
					{{ $errors->first('price') }}
				</div>
				@endif
				<div class="form-group">
					<label>Giảm giá</label>
					<input name="promotional" id="promotional" class="form-control" placeholder="Giảm giá ">
				</div>
				@if($errors->has('promotional'))
				<div class="alert alert-danger">
					{{ $errors->first('promotional') }}
				</div>
				@endif
				<div class="form-group">
					<label>Danh mục sản phẩm</label>
					<select name="idCategory" class="form-control idCategory" onchange="changeCategory()">
						@foreach($category as $val)
						<option value="{{ $val->id }}">{{ $val->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Loại sản phẩm</label>
					<select name="idProductType" class="form-control idProductType">
						@foreach($producttype as $val)
						<option value="{{ $val->id }}">{{ $val->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<input type="file" name="myFile">
				</div>
				@if($errors->has('myFile'))
				<div class="alert alert-danger">
					{{ $errors->first('myFile') }}
				</div>
				@endif
				<button type="submit" class="btn btn-success">Submit Button</button>
				<button type="reset" class="btn btn-primary">Reset Button</button>

			</form>

		</div>
	</div>
</div>
@endsection
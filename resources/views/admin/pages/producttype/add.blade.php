@extends('admin.layouts.master')

@section('title')
Thêm loại sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
	    <h6 class="m-0 font-weight-bold text-primary">Loại sản phẩm</h6>
	</div>
	<div class="row" style="margin: 5px">
	    <div class="col-lg-12">

	        <form role="form" action="{{ route('productType.store') }}" method="post">
	        	@csrf
	        	<fieldset class="form-group">
	        		<label>Name</label>
	        		<input class="form-control" name="name" placeholder="Nhập tên danh mục">
	        		@if($errors->has('name'))
	        		<div class="alert alert-danger">
	        			{{ $errors->first('name') }}
	        		</div>
	        		@endif
	        	</fieldset>
	            <div class="form-group">
	                <label>Status</label>
	                <select name="status" class="form-control">
	                    <option value="1">Hiển thị</option>
	                    <option value="0">Không hiển thị</option>
	                </select>
	            </div>
	            <div class="form-group">
	                <label>Category</label>
	                <select name="idCategory" class="form-control">
	                	@foreach($category as $val)
	                		<option value="{{ $val->id }}">{{ $val->name }}</option>
	                	@endforeach
	                </select>
	            </div>
	            <button type="submit" class="btn btn-success">Submit Button</button>
	            <button type="reset" class="btn btn-primary">Reset Button</button>

	        </form>

	    </div>
	</div>
</div>
@endsection
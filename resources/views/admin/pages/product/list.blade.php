@extends('admin.layouts.master')
@section('title')
Danh mục sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Promotional</th>
                        <th>Category</th>
                        <th>ProductType</th>
                        <th>Status</th>
                        <th>Ảnh</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Promotional</th>
                        <th>Category</th>
                        <th>ProductType</th>
                        <th>Status</th>
                        <th>Ảnh</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($product as $key=>$val)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->slug }}</td>
                        <td>{{ $val->description }}</td>
                        <td>{{ number_format($val->quantity) }}</td>
                        <td>{{ number_format($val->price) }}</td>
                        <td>{{ number_format($val->promotional) }}</td>
                        <td>
                            {{ empty($val->Category->name) ? '' : $val->Category->name }}</td>
                        <td>{{ empty($val->ProductType->name) ? '' : $val->ProductType->name }}</td>
                        <td>
                            @if(!empty($val->image))
                            <a data-fancybox="gallery" href="img/upload/product/{{ $val->image }}"><img style="width: 100px;height: 100px" src="img/upload/product/{{ $val->image }}"></a>
                            @endif
                        </td>
                        <td>
                            @if($val->status == 1) {{ "Hiển thị" }} @else {{ "Không hiển thị" }} @endif
                        </td>
                        <td>
                            <button class="btn btn-primary editProduct" title="{{ 'Sửa '.$val->name }}" data-toggle="modal" data-target="#modalSuaProduct" data-id="{{ $val->id }}"><i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btnDeleteProduct" title="{{ 'Xóa '.$val->name }}" data-toggle="modal" data-target="#modalXoaProduct" data-id="{{ $val->id }}"><i class="far fa-trash-alt" data-id="{{ $val->id }}"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pull-right">{{ $product->links() }}</div>
        </div>
    </div>
</div>
<input type="hidden" name="inputIdProduct" class="inputIdProduct">
<div id="modalSuaProduct" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa sản phẩm <span class="title"></p></h4>
            </div>
            <div class="modal-body">
                <form id="sfmProduct" enctype="multipart/form-data">
                <fieldset class="form-group">
                    <label>Tên sản phẩm</label>
                    <input class="form-control name" name="name" placeholder="Nhập tên sản phẩm">
                    <div class="alert alert-danger aleartName" style="">
                    </div>
                </fieldset>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Không hiển thị</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" id="description" class="form-control ckeditor description" placeholder="Nhập mô tả sản phẩm"></textarea>
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input name="quantity" id="quantity" class="form-control quantity" placeholder="Số lượng">
                </div>
                <div class="alert alert-danger alertQuantiTy">
                </div>
                <div class="form-group">
                    <label>Đơn giá</label>
                    <input name="price" id="price" class="form-control price" placeholder="Giá">
                </div>
                <div class="alert alert-danger alertPrice">
                </div>
                <div class="form-group">
                    <label>Giảm giá</label>
                    <input name="promotional" id="promotional" class="form-control promotional" placeholder="Giảm giá ">
                </div>
                <div class="alert alert-danger alertPromotional">
                </div>
                <div class="form-group">
                    <label>Danh mục sản phẩm</label>
                    <select name="idCategory" class="form-control idCategory" onchange="changeCategory()">
                    </select>
                </div>
                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <select name="idProductType" class="form-control idProductType">
                    </select>
                </div>
                <div class="form-group" id="imgPruduct" class="imgPruduct">
                </div>
                <div class="form-group">
                    <input type="file" name="myFile">
                </div>
                <div class="alert alert-danger alertImage">
                </div>
            </form>
            <div class="alert alertUpdateProduct">
            </div>
            <button type="submit" class="btn btn-success btnUpdateProduct" id="btnUpdateProduct">Submit Button</button>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="modalXoaProduct" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Xóa sản phẩm</h4>
            </div>
            <div class="modal-body">
              <div class="col-lg-12 divMessageDelete text-center font-weight-bold" style="font-size: 18px">
              </div>
              <div class="col-lg-12 text-center">
                <button type="button" class="btn btn-danger btnYesProduct" style="margin-right: 5px">Yes</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" style="margin-left: 5px">No</button>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection
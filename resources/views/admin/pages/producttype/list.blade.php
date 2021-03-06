@extends('admin.layouts.master')
@section('title')
Danh mục loại sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Loại sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($productType as $key=>$val)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->slug }}</td>
                        <td>
                            @if($val->status == 1) {{ "Hiển thị" }} @else {{ "Không hiển thị" }} @endif
                        </td>
                        <td>{{ empty($val->Category->name) ? '' : $val->Category->name }}</td>
                        <td>
                            <button class="btn btn-primary editProductType" title="{{ 'Sửa '.$val->name }}" data-toggle="modal" data-target="#modalSuaType" data-id="{{ $val->id }}"><i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btnDeleteProductType" title="{{ 'Xóa '.$val->name }}" data-toggle="modal" data-target="#modalXoaProductType" data-id="{{ $val->id }}"><i class="far fa-trash-alt" data-id="{{ $val->id }}"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pull-right">{{ $productType->links() }}</div>
        </div>
    </div>
</div>
<input type="hidden" name="inputIdProductType" class="inputIdProductType">
<div id="modalSuaType" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa productType <span class="title"></p></h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="col-lg-12 divMessage text-center font-weight-bold" style="font-size: 18px">
                    </div>
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                            <label>Name</label>
                            <input class="form-control name" name="name" placeholder="Nhập tên danh mục">
                        </fieldset>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control status">
                                <option value="1" class="ht">Hiển thị</option>
                                <option value="0" class="kht">Không hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Categry</label>
                            <select name="idCategory" class="form-control idCategory">
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btnSuaProductType">Submit Button</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="modalXoaProductType" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Xóa productType</h4>
            </div>
            <div class="modal-body">
              <div class="col-lg-12 divMessageDelete text-center font-weight-bold" style="font-size: 18px">
              </div>
              <div class="col-lg-12 text-center">
                <button type="button" class="btn btn-danger btnYesProductType" style="margin-right: 5px">Yes</button>
                <button type="button" class="btn btn-success btnNoProductType" data-dismiss="modal" style="margin-left: 5px">No</button>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection
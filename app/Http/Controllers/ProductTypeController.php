<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTypes;
use App\Models\Categories;
use App\Http\Requests\StoreProductTypeRequest;
use Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productType = ProductTypes::paginate(5);
        return view('admin.pages.producttype.list',compact('productType'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Categories::where('status', 1)->get();
        return view('admin.pages.producttype.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        //
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        $tamp = ProductTypes::create($data);
        if($tamp){
            return redirect()->route('productType.index')->with('thongBao','Đã thêm thành công loại sản phẩm');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Categories::where('status',1)->get();
        $producttype = ProductTypes::find($id);
        return response()->json(['category' => $category,'producttype' => $producttype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request ->all(),[
            'name' => 'required|min:2|max:255'
        ],[
            'required' => 'Tên loại sản phẩm không được để trống',
            'min' => 'Tên loại sản phẩm phải từ 2 đến 255 kí tự',
            'max' => 'Tên loại sản phẩm phải từ 2 đến 255 kí tự',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>'true','message' => $validator->error()],200);
        }
        $producttype = ProductTypes::find($id);
        $producttype ->update([
            'idCategory' => $request->idCategory,
            'name' => $request->name,
            'slug' => utf8tourl($request->name),
            'status' => $request->status,
        ]);
        return response()->json(['error'=>'false','message' => 'Cập nhật thành công'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producttype = ProductTypes::find($id);
        if($producttype ->delete()){
            return response()->json(['message' =>'Xóa thành công']);
        }else{
            return response()->json(['message' =>'Xóa thất bại']);
        }
    }
}

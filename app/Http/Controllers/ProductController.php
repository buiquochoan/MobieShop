<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductTypes;
use App\Models\Categories;
use App\Http\Requests\StoreProductRequest;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::with(['Category','ProductType'])->paginate(5);
        return view('admin.pages.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Categories::where('status',1)->get();
        $categoryFirstId = Categories::first();
        $categoryFirstId = empty($categoryFirstId) ? 0 : $categoryFirstId->id;
        $producttype = ProductTypes::where('idCategory',$categoryFirstId)->where('status',1)->get();
        return view('admin.pages.product.add',compact(['producttype','category']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        $data = $request->all();
        if ($request->hasFile('myFile')) {
            $file = $request->myFile;
            $fileName = date('d-m-Y').'_'.rand().'_'.utf8tourl($file->getClientOriginalName());
            if($file->move('img/upload/product', $fileName)){
                $data['slug'] = utf8tourl($request->name);
                $data['image'] = $fileName;
                if(Product::create($data)){
                    return redirect()->route('product.index');
                }else{
                    return back()->with(['customErrors' => 0,'customMessage' => 'Không thêm mới được sản phẩm']);
                }
            }else{

            }
        }else{

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        $category = Categories::where('status',1)->get();
        $categoryFirstId = Categories::first();
        $categoryFirstId = empty($categoryFirstId) ? 0 : $categoryFirstId->id;
        $producttype = ProductTypes::where('idCategory',$categoryFirstId)->where('status',1)->get();
        return response()->json(['product' => $product,'producttype' => $producttype,'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'quantity' => 'numeric|required|digits_between:0,11',
            'price' => 'numeric|required|min:0|between:0,9999999999.99',
            'promotional' => 'numeric|required|min:0|between:0,9999999999.99',
            'myFile' => 'mimes:jpg,jpeg,png,bmp,tiff|max:5120',
        ],
        [
            'min' => ':attribute phải từ 2 đến 255 ký tự',
            'name.max' => 'Tên sản phẩm phải từ 2 đến 255 ký tự',
            'myFile.max' => 'File upload phải nhỏ hơn 5MB',
            'required' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            'mimes' => ':attribute phải là ảnh',
            'digits_between' => ':attribute phải từ 0 đến 11 con số',
            'between' => ':attribute phải từ 0 đến 9999999999.99',
        ],
        [
             'name' => 'Tên sản phẩm',   
             'quantity'=>'Số lượng',
             'price'=>'Đơn giá',
             'promotional'=>'Khuyến mại',
             'myFile' => 'File upload',
        ]);
        if($validator ->fails()){
            return response()->json($validator->errors());
        }
        $product = Product::find($id);
        if($request->hasFile('myFile')){
            if(!empty($product->image)){
                unlink('img/upload/product/'.$product->image);
            }
            $file = $request->myFile;
            $fileName = date('d-m-Y').'_'.rand().'_'.utf8tourl($file->getClientOriginalName());
            if($file->move('img/upload/product', $fileName)){
                $data = $request->all();
                $data['slug'] = utf8tourl($request->name);
                $data['image'] = $fileName;
                if($product->update($data)){
                    return response()->json(['error' => 0,'file' => 1,'message'=>'Sửa sản phẩm thành công']);
                }
            }else{
                return response()->json(['error' => 1,'file' => 1,'message'=>'Sửa sản phẩm thất bại']);
            }
        }else{
            $data = $request->all();
            $data['slug'] = utf8tourl($request->name);
            $data['image'] = $product->image;
            if($product->update($data)){
                return response()->json(['error' => 0,'file' => 0,'message'=>'Sửa sản phẩm thành công']);
            }else{
                return response()->json(['error' => 0,'file' => 0,'message'=>'Sửa sản phẩm thất bại']);
            }
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $image = Product::find($id);
        if(Product::destroy($id)){
            if(!empty($image->image)){
                unlink('img/upload/product/'.$image->image);
            }
            return response()->json('Xóa thành công !');
        }else{
            return response()->json('Xóa thất bại !');
        }
    }
}

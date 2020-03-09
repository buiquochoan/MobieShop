<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductTypes;
use App\Models\Categories;
use App\Http\Requests\StoreProductRequest;

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
    public function update(Request $request, Product $product)
    {
        //
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

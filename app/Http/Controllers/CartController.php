<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\ProductTypes;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Mail\ShoppingMail;
use Cart;
use Auth;
use Mail;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $categories = Categories::where('status',1)->with('ProductTypes')->get();
        $productTypes = ProductTypes::where('status',1)->get();
        view()->share(['categories' => $categories,'productTypes' => $productTypes]);
    }
    public function index()
    {
        //
        $cart = Cart::content();
        return view('client.pages.cart',compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $customer = Customer::find($data['idCustomer']);
        $insert['name'] = $customer->User->name;
        $insert['code_order'] = 'order'.rand();
        $insert['address'] = $customer->address;
        $insert['email'] = $customer->email;
        $insert['phone'] = $customer->phone;
        $insert['idUser'] = $customer->idUser;
        $insert['message'] = $request->txtGhiChuThanhToan;
        $insert['money'] = $request->txtTotalMoney;
        $order = Order::create($insert);
        $idOrder = $order->id;
        $orderInsert= [];
        $orderDetails = [];
        foreach (Cart::content() as $key => $val) {
            # code...
            $orderDetail['idOrder'] = $idOrder;
            $orderDetail['idProduct'] = $val->id;
            $orderDetail['quantity'] = $val->qty;
            $orderDetail['price'] = $val->price;
            $orderDetails[$key] = OrderDetail::create($orderDetail);
        }
        Mail::to($order->email)->send(new ShoppingMail($order,$orderDetails));
        Cart::destroy();
        return response()->json(['Đã mua hàng thành công'],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.  
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->ajax()){
            Cart::update($id,$request->qty);
            return response()->json(['result' => 'Đã cập nhật số lượng thành công']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::remove($id);
        return response()->json(['message' => 'Xóa sản phẩm thành công']);
    }

    public function addCart($id,Request $request){
        $product = Product::find($id);
        if($request->qty){
            $qty = $request->quantity;
        }else{
            $qty = 1;
        }
        if($product->promotional > 0){
            $price = $product->promotional;
        }else{
            $price = $product->price;
        }
        $cart = ['id' => $id,'name' => $product->name,'qty' => $qty,'price' => $product->price,'options' => ['img' => $product->image]];
        Cart::add($cart);
        return back()->with(['ctSuccess' =>1,'ctMessage' => 'Thêm vào giỏ hàng '.$product->name]);
    }

    public function checkout(){
        $user = Auth::user();
        $price = str_replace(',', '', Cart::total());
        return view('client.pages.checkout',compact(['user','price']));
    }
}

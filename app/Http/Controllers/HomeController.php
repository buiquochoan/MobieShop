<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\ProductTypes;
use App\Models\Product;
use Cart;
use Auth;

class HomeController extends Controller
{
    //
    public function __construct(){
    	$categories = Categories::where('status',1)->with('ProductTypes')->get();
    	$productTypes = ProductTypes::where('status',1)->get();
    	view()->share(['categories' => $categories,'productTypes' => $productTypes]);
    }
    public function index(){
    	$newMobie = Product::with(['Category','ProductType'])->where('status',1)->orderBy('id','desc')->limit(3)->get();
    	$productTypesFirst = ProductTypes::first();
    	$mobie2 = [];
    	if(!empty($productTypesFirst)){
    		$mobie2 = Product::where('idProductType',$productTypesFirst->id)->where('status',1)->limit(3)->get();
    	}
    	return view('client.pages.index',compact(['newMobie','mobie2','productTypesFirst']));
    }
}

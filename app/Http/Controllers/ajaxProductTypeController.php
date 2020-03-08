<?php

namespace App\Http\Controllers;
use App\Models\ProductTypes;

use Illuminate\Http\Request;

class ajaxProductTypeController extends Controller
{
    //
    public function getProductType($idCategory)
    {
    	# code...
    	$productType = ProductTypes::where('idCategory',$idCategory)->where('status',1)->get();
    	return response()->json($productType);
    }
}

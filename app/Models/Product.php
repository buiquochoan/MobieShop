<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'product';
    protected $fillable = [
		'name','slug','description','quantity','price','image','promotional','idCategory','idProductType','status',
    ];
    public function Category()
    {
    	# code...
    	return $this->belongsTo('App\Models\Categories','idCategory','id')->where('status',1);
    }
    public function ProductType()
    {
    	# code...
    	return $this->belongsTo('App\Models\ProductTypes','idProductType','id')->where('status',1);
    }
}

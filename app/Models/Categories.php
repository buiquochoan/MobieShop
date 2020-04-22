<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'category';
    protected $fillable = [
    	'name','slug','status',
    ];
    public function ProductTypes()
    {
    	# code...
    	return $this->hasMany('App\Models\ProductTypes','idCategory','id')->where('status',1);
    }
}

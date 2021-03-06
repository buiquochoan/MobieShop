<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'order';
    protected $fillable = [
		'code_order','idUser','name','address','email','phone','money','message','status',
    ];
    public function User()
    {
    	# code...
    	return $this->belongsTo('App\Models\User','idUser','id');
    }
}

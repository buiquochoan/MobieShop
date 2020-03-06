<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contac extends Model
{
    //
    protected $table = 'contacs';
    protected $fillable = [
    	'idUser','message',
    ];
    public function User()
    {
    	# code...
    	return $this->belongsTo('App\Models\User','idUser','id');
    }
}

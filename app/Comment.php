<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "Comment";

    public function giay(){
    	return $this->belongsTo('App\Giay','idGiay','id');
    }

    public function user(){
    	return $this->belongsTo('App\User','idUser','id');
    }
}

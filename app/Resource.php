<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
    public function category(){
        $categories = $this->belongsTo('App\Category','category', 'id');
        //print_r($categorys);
        return $categories;
    }

    public function user(){
        $user = $this->belongsTo('App\User', 'user_id', 'unique_id');
        return $user;
    }

    public function city(){
        $city = $this->belongsTo('App\City', 'place', 'Id');
        return $city;
    }
}

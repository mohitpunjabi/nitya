<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model {


    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

}

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

    public function getLinkAttribute() {
        return str_replace('http://', '', url($this->attributes['access_key']));
    }

}

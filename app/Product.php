<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = [
        'design_no',
        'name',
        'description',
        'available'
    ];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function catalogues()
    {
            return $this->belongsToMany('App\Catalogue');
    }

}

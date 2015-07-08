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
            return $this->belongsToMany('App\Catalogue')->withTimestamps();
    }

    public function scopeInCatalogue($query, $catalogue) {
        return $query->whereHas('catalogues', function($q) use(&$catalogue) {
            $q->where('name', 'like', $catalogue);
        })->latest();
    }

    public function scopeAvailable($query) {
        return $query->where('available', true);
    }

    public function getCatalogueListAttribute() {
        return $this->catalogues()->lists('catalogue_id');
    }

}

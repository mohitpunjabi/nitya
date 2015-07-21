<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Product extends Model {

    protected $fillable = [
        'design_no',
        'name',
        'description',
        'available',
        'length',
        'neckline',
        'fabric',
        'rinse_care'
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

    public function scopeVisibleToUser($query, $order = true) {
        if(Auth::user()) {
            if($order) return $query->latest();
            return $query;
        }

        $catalogues = ['public'];
        if(Session::has('catalogue')) array_push($catalogues, Session::get('catalogue')->name);
        $query = $query->available()->whereHas('catalogues', function($q) use (&$catalogues) {
            $q->whereIn('name', $catalogues);
        });

        if($order) $query = $query->latest();

        return $query;
    }

    public function scopeSearch($query, $searchTerm) {
        return $query->visibleToUser()
            ->where(function($q) use (&$searchTerm) {
            $q->where('design_no', 'like', "%$searchTerm%")
                ->orWhere('name', 'like', "%$searchTerm%")
                ->orWhere('description', 'like', "%$searchTerm%")
                ->orWhere('fabric', 'like', "%$searchTerm%")
                ->orWhere('length', 'like', "%$searchTerm%")
                ->orWhere('rinse_care', 'like', "%$searchTerm%");
        });
    }

    public function getPreviousAttribute() {
        return Product::visibleToUser(false)->where('created_at', '>', $this->created_at)->orderBy('created_at', 'asc')->first();
    }

    public function getNextAttribute() {
        return Product::visibleToUser(false)->where('created_at', '<', $this->created_at)->orderBy('created_at', 'desc')->first();
    }

    public function getSimilarProductsAttribute() {
        return Product::visibleToUser(false)->where('id', '!=', $this->id)->orderByRaw('RAND()')->limit(4)->get();
    }

    public function getCatalogueListAttribute() {
        return $this->catalogues()->lists('catalogue_id');
    }

    public function getSlugAttribute() {
        return str_slug($this->name);
    }

    public function enquiries() {
        return $this->hasMany('App\Enquiry');
    }

}

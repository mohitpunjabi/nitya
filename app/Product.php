<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function scopeVisibleToUser($query, $order = true) {
        if(Auth::user()) return $query->latest();
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
                ->orWhere('description', 'like', "%$searchTerm%");
        });
    }

    public function getPreviousAttribute() {
        return Product::visibleToUser(false)->where('created_at', '>', $this->created_at)->orderBy('created_at', 'asc')->first();
    }

    public function getNextAttribute() {
        return Product::visibleToUser(false)->where('created_at', '<', $this->created_at)->orderBy('created_at', 'desc')->first();
    }

    public function getCatalogueListAttribute() {
        return $this->catalogues()->lists('catalogue_id');
    }

    public function enquiries() {
        return $this->hasMany('App\Enquiry');
    }

}

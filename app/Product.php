<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Product extends Model {

    protected $fillable = [
        'design_no',
        'name',
        'description',
        'available',
        'sizes',
        'length',
        'neckline',
        'fabric',
        'rinse_care',
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
        })->with(Product::getAssociatedModels());
    }

    private function getCacheKey($attribute) {
        $attrKey = Session::get('catalogue')? Session::get('catalogue')->id: '';
        if(Auth::user()) $attrKey .= 'admin';
        $attrKey = $attribute . '_' . $this->id . '_' . $attrKey;
        return $attrKey;
    }

    public function getPreviousAttribute() {
        return Cache::remember($this->getCacheKey('prev'), 120, function() {
            return Product::visibleToUser(false)
                ->where('created_at', '>', $this->created_at)
                ->orderBy('created_at', 'asc')
                ->first();
        });
    }

    public function getNextAttribute() {
        return Cache::remember($this->getCacheKey('next'), 120, function() {
            return Product::visibleToUser(false)
                ->where('created_at', '<', $this->created_at)
                ->orderBy('created_at', 'desc')
                ->first();
        });
    }

    public function getSimilarProductsAttribute() {
        return Cache::remember('similar_' . $this->id, 120, function() {
            return Product::visibleToUser(false)
                ->where('id', '!=', $this->id)->orderByRaw('RAND()')
                ->limit(4)
                ->with(Product::getAssociatedModels())
                ->get();
        });
    }

    public static function getAssociatedModels() {
        if(Auth::user()) return ['images', 'catalogues'];
        return ['images'];
    }

    public function getCatalogueListAttribute() {
        return $this->catalogues()->lists('catalogue_id');
    }

    public function getSlugAttribute() {
        return str_slug($this->name);
    }

    public function getThumbnailMarkupAttribute() {
        return View::make('products.partials.thumbnail', ['product' => $this])->render();
    }

    public function enquiries() {
        return $this->hasMany('App\Enquiry');
    }

    public function orders() {
        return $this->belongsToMany('App\Order')->withPivot('unit_price', 'quantity');
    }

}

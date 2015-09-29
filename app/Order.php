<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model {


    protected $fillable = [
        'billing_name',
        'billing_address',
        'billing_contact',
        'billing_email',
        'discount',
        'shipping_charges'
    ];

    protected $appends = [
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('unit_price', 'quantity');
    }

    public function getAmountAttribute() {
        return $this->products()->select(DB::raw('sum(unit_price * quantity) amount'))->first()->amount + $this->shipping_charges;
    }

    public function getLinkAttribute() {
        return url('orders/track/'.  $this->attributes['tracking_id']);
    }

    public function getTotalQuantityAttribute() {
        $totalQuantity = 0;
        foreach($this->products as $product) $totalQuantity += $product->pivot->quantity;
        return $totalQuantity;
    }
}
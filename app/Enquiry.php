<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model {

	protected $fillable = [
        'name',
        'email',
        'contact',
        'message'
    ];

    public function product() {
        return $this->belongsTo('App\Product');
    }

}

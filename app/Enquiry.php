<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model {

    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

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

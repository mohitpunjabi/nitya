<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends Model {

    protected $fillable = [
        'name'
    ];

    private static $SIZES = [
        'lg' => [0, 2000],
        'md' => [650, 0],
        'sm' => [400, 0],
        'xs' => [0, 120]
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function setNameAttribute(UploadedFile $imageFile)
    {
        $this->attributes['name'] = $this->storeSnapshots($imageFile);
    }

    private function storeSnapshots(UploadedFile $image) {
        $imageName = str_random(12) . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->getRealPath();
        $this->storeImages($imageName, $imagePath);
        return $imageName;
    }

    private function storeImages($imageName, $imagePath) {
        $interImage = \Intervention\Image\Facades\Image::make($imagePath);
        foreach(Image::$SIZES as $folder => $size) {
            if($size[0] > 0) {
                $interImage->widen($size[0], function($constraint) {
                    $constraint->upsize();
                })->save('img/' . $folder . '/' . $imageName);
            }
            else {
                $interImage->heighten($size[1], function($constraint) {
                    $constraint->upsize();
                })->save('img/' . $folder . '/' . $imageName);
            }
        }
    }

    public function pathForSize($width = 0, $height = 0) {
        foreach(Image::$SIZES as $folder => $size) {
            if($size[0] > 0) {
                if($width <= Image::$SIZES[$folder][0]) return $this->path($folder);
            }
            else {
                if($height <= Image::$SIZES[$folder][1]) return $this->path($folder);
            }
        }

        return $this->path('md');
    }

    public function path($size) {
        if(isset(Image::$SIZES[$size])) return asset('img/' . $size . '/' . $this->name);
        return $this->path('md');
    }
}
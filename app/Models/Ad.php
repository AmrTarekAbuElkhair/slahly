<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ad extends Model
{
    use HasFactory;
    protected $table='ads';
    protected $fillable=['status','url','image','type','offer_id','package_id','start_date','end_date'];
    public function offer(){
        return $this->belongsTo(Offer::class, 'offer_id','id');
    }
    public function package(){
        return $this->belongsTo(Package::class, 'package_id','id');
    }
    public function getImageAttribute($value)
    {
        if (isset($value)) {
            return asset('media/ads/'.$value);
        }else{
            $default_image=Setting::first()->default_image;
            return $default_image;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/ads/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
}

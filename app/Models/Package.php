<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory,Translatable;
    protected $table='packages';
    protected $fillable=['status','image','price'];
    public $translatedAttributes =  ['name'];

    public function getImageAttribute($value)
    {
        if (isset($value)) {
            return asset('media/packages/'.$value);
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
            $value->move(public_path('media/packages/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
}

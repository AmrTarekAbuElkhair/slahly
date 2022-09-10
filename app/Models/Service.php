<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model
{
    use HasFactory,Translatable;
    protected $table = 'services';
    public $translatedAttributes =  ['name','desc'];
    protected $fillable = ['status','icon'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getIconAttribute($value)
    {
        if ($value) {
            return asset('media/services/'.$value);
        } else {
            $default_image=Setting::first()->default_image;
            return $default_image;
        }
    }

    public function setIconAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/services/'),$imageName);
            $this->attributes['icon']=$imageName;
        }
    }

}

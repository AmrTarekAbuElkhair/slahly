<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory,Translatable;
    protected $table = 'countries';
    public $translatedAttributes =  ['name'];
    protected $fillable = ['status','digits','logo','code'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getLogoAttribute($value)
    {
        if (isset($value)) {
            return asset('media/countries/'.$value);
        }else{
            $default_image=Setting::first()->default_image;
            return $default_image;
        }
    }
    public function setLogoAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/countries/'),$imageName);
            $this->attributes['logo']=$imageName;
        }
    }
}

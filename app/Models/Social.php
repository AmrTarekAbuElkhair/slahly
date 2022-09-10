<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $table='socials';
    protected $fillable=['url','logo'];

    public function getLogoAttribute($value)
    {
        if (isset($value)) {
            return asset('media/settings/'.$value);
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
            $value->move(public_path('media/settings/'),$imageName);
            $this->attributes['logo']=$imageName;
        }
    }
}

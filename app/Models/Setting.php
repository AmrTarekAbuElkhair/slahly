<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory,Translatable;
    protected $table = 'settings';
    public $translatedAttributes =  ['desc','about','terms','privacy_users','privacy_providers'];
    protected $fillable = [
        'logo', 'phone','email','address','youtube','whatsapp','help_phone','management_phone','default_image',
		'android_version_user','android_version_provider','ios_version_user','ios_version_provider'];
    protected $hidden=['translations'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function setLogoAttribute($value)
    {
        if ($value)
        {
            $imageName='logo.jpg';
            $value->move(public_path('media/settings/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
    public function getLogoAttribute($value)
    {
        if ($value) {
            return asset('media/settings/'.$value);
        }
    }

    public function getDefaultImageAttribute($value)
    {
        if ($value) {
            return asset('media/settings/'.$value);
        }
    }

    public function setDefaultImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/settings/'),$imageName);
            $this->attributes['default_image']=$imageName;
        }
    }


}

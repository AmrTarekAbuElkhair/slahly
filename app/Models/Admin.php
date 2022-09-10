<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable,HasRoles;
    protected $guard = 'admin';

    protected $table="admins";

    protected $primaryKey='id';




    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'name', 'email', 'password','image'
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('media/admins/'.$value);
        } else {
            $default_image=Setting::first()->default_image;
            return $default_image;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/admins/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

}

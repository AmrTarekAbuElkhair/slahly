<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','mobile','email','service_id','type_id','city',
        'lat','lng','address','verified_status','status','country_id',
        'available','firebase_token','bio','gender','image','rate','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('media/users/'.$value);
        } else {
            return asset('media/users/user.png');
        }
    }

    public function getMobileAttribute($value)
    {
//        if ($value) {
//            return asset('media/users/'.$value);
//        } else {
//            return asset('media/users/user.png');
//        }
       return substr($value, 3,20);
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/users/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

    public function getRateAttribute($value)
    {
        return $value != null ?  number_format($value,1):"0.0" ;

    }


}

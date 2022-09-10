<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = ['service_id','package_id', 'percentage', 'status', 'image',
        'price_before_sale','price_after_sale'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'package_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'service_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if (isset($value)) {
            return asset('media/offers/' . $value);
        }else{
            $default_image=Setting::first()->default_image;
            return $default_image;
    }
    }

}

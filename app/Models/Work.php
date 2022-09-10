<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Work extends Model
{
    use HasFactory;
    protected $table='works';
    protected $fillable = ['worker_id','image'];
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('media/works/'.$value);
        } else {
            $default_image=Setting::first()->default_image;
            return $default_image;
        }
    }
    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=uniqid().time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('media/works/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

}

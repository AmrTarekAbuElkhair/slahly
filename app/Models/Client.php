<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Client extends Model
{
    use HasFactory,Translatable;
    protected $table='clients';
    protected $hidden=['translations'];
    public $translatedAttributes =  ['name','desc'];
    protected $fillable = ['status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

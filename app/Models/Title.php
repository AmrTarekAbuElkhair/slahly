<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory,Translatable;
    protected $table = 'titles';
    protected $hidden=['translations'];
    public $translatedAttributes =  ['title'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

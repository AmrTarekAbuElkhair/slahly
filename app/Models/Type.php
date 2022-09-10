<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory,Translatable;
    protected $table='types';
    protected $fillable=['status'];
    public $translatedAttributes =  ['name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

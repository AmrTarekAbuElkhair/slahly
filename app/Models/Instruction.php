<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory,Translatable;
    protected $table = 'instructions';
    public $translatedAttributes =  ['text'];
    protected $fillable = ['status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory,Translatable;
    protected $table = 'notifications';
    public $translatedAttributes =  ['title','desc'];
    protected $fillable = ['status', 'type','redirect'];
   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    use HasFactory;

    protected $table = 'service_translations';


    protected $primaryKey = 'services_trans_id';


    protected $fillable = ['name','desc'];


    public $timestamps = false;

}

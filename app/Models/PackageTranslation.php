<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    use HasFactory;
    protected $table = 'package_translations';
    protected $primaryKey = 'packages_trans_id';
    protected $fillable = ['name'];
    public $timestamps = false;

}

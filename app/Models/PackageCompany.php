<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCompany extends Model
{
    use HasFactory;
    protected $table='package_companies';
    protected $fillable=['package_id','provider_id'];

    public function package()
    {
        return $this->belongsTo(package::class,'package_id','id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id','id');
    }

}

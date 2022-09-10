<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackageService extends Model
{
    use HasFactory;
    protected $table='order_package_services';
    protected $fillable=['package_id','order_id','service_id','status'];
    protected $appends=['service_name'];
    public function getServiceNameAttribute(){
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return ServiceTranslation::where('service_id',$this->service_id)->where('locale',$lang)->first()->name;
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}

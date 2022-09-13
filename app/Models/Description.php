<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory,Translatable;
    protected $table='descriptions';
    protected $fillable=['package_id','service_id'];
    public $translatedAttributes =  ['text'];
    protected $appends=['service_name','desciption'];
    protected $hidden=['created_at','updated_at'];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
    public function getServiceNameAttribute(){
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return ServiceTranslation::where('service_id',$this->service_id)->where('locale',$lang)->first()->name;
    }

    public function getDesciptionAttribute(){
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return DescriptionTranslation::where('description_id',$this->id)->where('locale',$lang)->get();
    }

}

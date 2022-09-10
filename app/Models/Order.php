<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'user_id','provider_id','service_id','visit_date','visit_time',
        'offer_id','order_number','price','status','date',
        'payment_status','payment','time','working_hours',
        'title','city','lat','lng','mobile','package_id',
        'notes','apartment_no', 'floor_no','mark','finish_time'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function provider(){
        return $this->belongsTo(User::class, 'provider_id','id');
    }
    public function service(){
        return $this->belongsTo(Service::class, 'service_id','id');
    }
    public function offer(){
        return $this->belongsTo(Offer::class, 'offer_id','id');
    }
    public function package(){
        return $this->belongsTo(Package::class, 'package_id','id');
    }
    public function getCreatedAtAttribute(){
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->locale($lang)->diffForHumans();
    }

    public function getTimeFromAttribute()
    {
        return Carbon::parse($this->attributes['time_from'])->format('G:i a');
    }

    public function getTimeToAttribute()
    {
        return Carbon::parse($this->attributes['time_to'])->format('G:i a');
    }

    public function getDateAttribute(){
        //$lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        //return Carbon::parse($this->attributes['date'])->locale($lang)->translatedFormat('d M Y');
		return Carbon::parse($this->attributes['date'])->format('d M Y');
    }
}

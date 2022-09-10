<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationContent extends Model
{
    use HasFactory;
    protected $table='notification_contents';
    protected $fillable=[
        'notification_id','order_id','user_id',
        'provider_id'];

    public function notification()
    {
        return $this->belongsTo(Notification::class,'notification_id','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id','id');
    }

    public function getCreatedAtAttribute(){
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->locale($lang)->diffForHumans();
    }
}

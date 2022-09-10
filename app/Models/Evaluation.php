<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $table='evaluations';
    protected $fillable=[
        'user_id','provider_id','order_id',
        'user_rate','user_comment','provider_rate','provider_comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id', 'id');
    }

    public function getCreatedAtAttribute(){
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->locale($lang)->diffForHumans();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationReason extends Model
{
    use HasFactory;
    protected $table='cancellation_reasons';
    protected $fillable=['user_id','provider_id','user_type','order_id','reason_id'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function provider(){
        return $this->belongsTo(User::class, 'provider_id','id');
    }
    public function reason(){
        return $this->belongsTo(Reason::class, 'reason_id','id');
    }
}

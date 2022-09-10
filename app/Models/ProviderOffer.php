<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderOffer extends Model
{
    use HasFactory;
    protected $table='provider_offers';
    protected $fillable=['offer_id','company_id','worker_id'];
    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }
}

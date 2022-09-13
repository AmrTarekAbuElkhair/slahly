<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderOffer extends Model
{
    use HasFactory;
    protected $table='provider_offers';
    protected $fillable=['offer_id','provider_id'];
    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id','id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id', 'id');
    }
}

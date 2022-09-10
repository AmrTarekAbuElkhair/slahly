<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;
    protected $table='qr_codes';
    protected $fillable=['code','worker_id'];

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }
}

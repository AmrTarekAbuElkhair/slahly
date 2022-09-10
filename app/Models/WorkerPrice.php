<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPrice extends Model
{
    use HasFactory;
    protected $table='worker_prices';
    protected $fillable=['worker_id','price'];

    public function worker(){
        return $this->belongsTo(User::class, 'worker_id','id');
    }
}

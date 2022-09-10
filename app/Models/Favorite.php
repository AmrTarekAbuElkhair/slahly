<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table='favorites';
    protected $fillable=['user_id','worker_id','company_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(User::class, 'company_id', 'id');
    }
}

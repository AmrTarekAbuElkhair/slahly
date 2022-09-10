<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Wallet extends Model
{
    use HasFactory;
    protected $table='wallets';
    protected $fillable=['status','worker_id','user_id','title_id','price','type','op_number','account_number'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function worker(){
        return $this->belongsTo(User::class, 'worker_id','id');
    }
    public function title(){
        return $this->belongsTo(Title::class, 'title_id','id');
    }

    public function getCreatedAtAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->format('d-m-Y');
    }

}

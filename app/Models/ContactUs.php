<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $table='contact_us';
    protected $primaryKey='id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [ 'user_id','name','email','phone','user_message','admin_message','admin_id'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}

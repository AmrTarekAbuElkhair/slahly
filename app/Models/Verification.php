<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;
    protected $table="verifications";

    protected $primaryKey='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable=['user_id', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

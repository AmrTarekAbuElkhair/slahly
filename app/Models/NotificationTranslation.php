<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTranslation extends Model
{
    protected $table = 'notification_translations';
    protected $primaryKey = 'notification_trans_id';
    protected $fillable = ['title','desc'];
    public $timestamps = false;

}

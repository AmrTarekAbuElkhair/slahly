<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;
    protected $table = 'setting_translations';
    protected $primaryKey = 'settings_trans_id';
    protected $fillable = ['desc','about','terms','privacy','privacy_users','privacy_providers'];
    public $timestamps = false;
}

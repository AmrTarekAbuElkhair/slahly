<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionTranslation extends Model
{
    use HasFactory;
    protected $table = 'description_translations';
    protected $primaryKey = 'descriptions_trans_id';
    protected $fillable = ['text'];
    protected $hidden = ['descriptions_trans_id','description_id','locale'];
    public $timestamps = false;
}

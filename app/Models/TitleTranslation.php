<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleTranslation extends Model
{
    use HasFactory;
    protected $table = 'title_translations';
    protected $primaryKey = 'titles_trans_id';
    protected $fillable = ['title'];
    public $timestamps = false;
}

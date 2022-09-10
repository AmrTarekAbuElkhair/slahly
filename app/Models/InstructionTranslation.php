<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionTranslation extends Model
{
    use HasFactory;
    protected $table = 'instruction_translations';
    protected $primaryKey = 'instructions_trans_id';
    protected $fillable = ['text'];
    public $timestamps = false;
}

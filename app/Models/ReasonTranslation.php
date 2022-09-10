<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonTranslation extends Model
{
    use HasFactory;
    protected $table = 'reason_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'reasons_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}

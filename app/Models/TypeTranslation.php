<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    use HasFactory;
    protected $table = 'type_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'types_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}

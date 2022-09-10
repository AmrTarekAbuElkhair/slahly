<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTranslation extends Model
{
    use HasFactory;
    protected $table = 'client_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'clients_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name','desc'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}

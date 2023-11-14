<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'debts';
    // +----------------------------------------------------------------------------------+
    // | ID                                                                               |
    // +----------------------------------------------------------------------------------+
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // +----------------------------------------------------------------------------------+
    // | ATTRIBUTES                                                                       |
    // +----------------------------------------------------------------------------------+
    protected $fillable = [
        'id', 'usr_id', 'cat_id',
        'name', 'amount', 'period',
        'day', 'date_at',
        'file', 'observation', 'status',
    ];

    protected $hidden = [
        'usr_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    protected $casts = [
        'id'           => 'integer',
        'usr_id'       => 'integer',
        'cat_id'       => 'integer',
        'name'         => 'string',
        'amount'       => 'double',
        'period'       => 'string',
        'day'          => 'integer',
        'date_at'      => 'datetime',
        'file'         => 'string',
        'observation'  => 'string',
        'status'       => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];
    // +----------------------------------------------------------------------------------+
    // | OTHERS                                                                           |
    // +----------------------------------------------------------------------------------+
    public $timestamps = true;
    protected $dateFormat = 'U';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingress extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ingresses';
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
        'id', 'cta_id', 'sav_id', 'deb_id', 'acc_id',
        'concept', 'description', 'reference', 'amount',
        'observation', 'file', 'status',
    ];

    protected $hidden = [
        'usr_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    protected $casts = [
        'id'           => 'integer',
        'usr_id'       => 'integer',
        'cta_id'       => 'integer',
        'sav_id'       => 'integer',
        'deb_id'       => 'integer',
        'acc_id'       => 'integer',
        'concept'      => 'string',
        'description'  => 'string',
        'reference'    => 'string',
        'amount'       => 'double',
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


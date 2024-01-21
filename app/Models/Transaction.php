<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transactions';
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
        'id', 'usr_id', 'ing_id', 'egr_id', 'acc_ing_id', 'acc_egr_id',
        'cls_id', 'cat_id', 'sav_id', 'deb_id',
        'concept', 'description', 'reference', 'amount',
        'observation', 'status',
    ];

    protected $hidden = [
        'file', 'usr_id', 'created_at', 'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'           => 'integer',
        'usr_id'       => 'integer',
        'ing_id'       => 'integer',
        'egr_id'       => 'integer',
        'acc_ing_id'   => 'integer',
        'acc_egr_id'   => 'integer',
        'cls_id'       => 'integer',
        'cat_id'       => 'integer',
        'sav_id'       => 'integer',
        'deb_id'       => 'integer',
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
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'banks';
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
        'id', 'usr_id', 'abbreviature', 'name',
        'observation', 'status',
    ];

    protected $hidden = [
        'usr_id', 'file', 'created_at', 'updated_at', 'deleted_at',
    ];

    protected $casts = [
        'id'           => 'integer',
        'usr_id'       => 'integer',
        'abbreviature' => 'string',
        'name'         => 'string',
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
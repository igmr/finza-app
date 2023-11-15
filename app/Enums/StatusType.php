<?php

namespace App\Enums;

enum StatusType: string
{
    case active   = 'Activo';
    case inactive = 'Inactivo';
    case cancel   = 'Cancelado';
}

<?php

namespace App\Enums;

enum MethodType: string
{
    case GET    = 'GET';
    case POST   = 'POST';
    case PUT    = 'PUT';
    case DELETE = 'DELETE';
}
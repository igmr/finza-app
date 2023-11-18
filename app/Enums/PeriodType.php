<?php

namespace App\Enums;

enum PeriodType: string
{
    case diary    = 'Diario';
    case weekly   = 'Semanal';
    case biweekly = 'Quincenal';
    case monthly  = 'Mensual';
    case annual   = 'Anual';
}
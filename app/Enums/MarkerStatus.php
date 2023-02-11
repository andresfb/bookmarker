<?php

namespace App\Enums;

enum MarkerStatus: string
{
    case ACTIVE = 'active';
    case ARCHIVED = 'archived';
    case HIDDEN = 'hidden';
}

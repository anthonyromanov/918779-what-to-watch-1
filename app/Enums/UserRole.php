<?php

namespace App\Enum;

enum UserRole: int
{
    case USER = 0;
    case MODERATOR = 1;
}

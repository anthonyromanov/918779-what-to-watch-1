<?php

namespace App\Enums;

enum FilmStatus: int
{
   case PENDING = 0;
   case MODERATE = 1;
   case READY = 2;
}

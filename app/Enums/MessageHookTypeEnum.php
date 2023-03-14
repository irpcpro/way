<?php

namespace App\Enums;

enum MessageHookTypeEnum:int
{
    case PRIVATE = 1;
    case GROUP = 2;
}

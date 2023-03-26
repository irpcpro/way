<?php

namespace App\Enums;

enum MessageTypeEnum:int
{
    case TEXT = 1;
    case ATTACHMENT = 2;
}

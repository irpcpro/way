<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class APIResponseFacade extends Facade {
    protected static function getFacadeAccessor(): string
    {
        return 'APIResponse';
    }
}

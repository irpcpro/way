<?php

namespace App\Providers;

use App\Http\Helpers\Facade\APIResponse;
use Illuminate\Support\ServiceProvider;

class APIResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('APIResponse',function($app, $data){
            return new APIResponse(...$data);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

//        Validator::extend('username_rule', function ($attribute, $value, $parameters, $validator) {
//            return preg_match('/^[A-Za-z0-9\.\_]+$/', $value);
//        });

//        Validator::extend('username', function ($attribute, $value, $parameters, $validator) {
//            $validator = Validator::make(
//                [$attribute => $value],
//                [$attribute => ['nullable', 'string', 'max:' . USERNAME_LENGTH, 'regex:' . REGEX_USERNAME],]
//                ,[
//                    'username.max' => 'username length should not be more than '.USERNAME_LENGTH.' characters.',
//                    'username.regex' => 'the character of username should be just letter or specific characters.',
//                ]
//            );
//            return $validator->passes();
//        });

    }
}

<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function prepareJsonResponse($request, Throwable $e)
    {
//        dd($this->convertExceptionToArray($e));
        if(!isset($this->convertExceptionToArray($e)['message']) || $this->convertExceptionToArray($e)['message'] == ""){
            $message = "خطایی رخ داده است";
        }else{
            $message = $this->convertExceptionToArray($e)['message'];
        }
        $error_code = $this->isHttpException($e) ? $e->getStatusCode() : 500;
        $getResponse = APIResponse($message, $error_code, false)->get();
        return new JsonResponse(
            $getResponse->original,
            $error_code,
            $this->isHttpException($e) ? $e->getHeaders() : [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

}

<?php

use Illuminate\Support\Facades\App;

function api_response($message = 'خطایی رخ داده است', $success = false, $arr = [], $data = null, $error_code = 200){
    $out = [
        'message' => $message,
        'success' => $success,
        'data' => $data,
        'error_code' => $error_code
    ];

    if(!empty($arr))
        $out = array_merge($out, $arr);

    return response()->json($out, $error_code);
}

if(!function_exists('APIResponse')){
    /**
     * @param mixed ...$data [message, error_code, success]
     * */
    function APIResponse(...$data){
        return app('APIResponse', $data);
    }
}


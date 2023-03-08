<?php

namespace App\Http\Helpers\Facade;

use Illuminate\Http\Exceptions\HttpResponseException;

class APIResponse
{

    public array|string|null $data = null;
    public array|string|null $extra = [];

    public function __construct(
        public string $message,
        public int $error_code = 200,
        public bool $success = false
    )
    {
        //
    }

    /**
     * @param array|string|null $data
     * @return APIResponse
     */
    public function setData(array|string|null $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param array|string|null $data
     * @return APIResponse
     */
    public function setExtra(array|string|null $data): static
    {
        $this->extra[] = $data;
        return $this;
    }

    public function send()
    {
        throw new HttpResponseException(
            $this->get()
        );
    }

    public function get(){
        $out = [
            'message' => $this->message,
            'success' => $this->success,
            'error_code' => $this->error_code,
            'data' => $this->data
        ];

        if(!empty($this->extra)) {
            $flattened_array = array_reduce($this->extra, 'array_merge', []);
            $out = array_merge($out, $flattened_array);
        }

        return response()->json($out, $this->error_code);
    }

}

<?php

namespace App\Http\Requests\Avatar;

use App\Http\Requests\AppRequest;
use const AVATAR_MIN_HEIGHT;
use const AVATAR_MIN_WiDTH;
use const AVATAR_SIZE;

class AvatarSetRequest extends AppRequest
{

    public $mimes;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->mimes = join(",", AVATAR_MIMES);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => [
                'required',
                'image',
                'mimes:' . $this->mimes,
                'max:' . AVATAR_SIZE,
                'dimensions:min_width=' . AVATAR_MIN_WiDTH . ',min_height=' . AVATAR_MIN_HEIGHT
            ],
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'avatar image is required.',
            'avatar.image' => 'avatar should be image file.',
            'avatar.mimes' => 'avatar format should be in these types : ' . $this->mimes,
            'avatar.max' => 'avatar image size should be '.AVATAR_SIZE.' KB',
            'avatar.uploaded' => 'The :attribute failed to upload.',
            'avatar.dimensions' => 'the with and height of image should be '.AVATAR_MIN_WiDTH.'x'.AVATAR_MIN_HEIGHT
        ];
    }

}

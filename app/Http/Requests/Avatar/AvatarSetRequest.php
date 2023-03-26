<?php

namespace App\Http\Requests\Avatar;

use App\Http\Requests\AppRequest;
use const AVATAR_MIN_HEIGHT;
use const AVATAR_MIN_WiDTH;
use const AVATAR_SIZE;

class AvatarSetRequest extends AppRequest
{

    public $mimes;
    public $size;
    public $min_width;
    public $min_height;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->mimes = join(",", AVATAR_MIMES);
        $this->size = AVATAR_SIZE;
        $this->min_width = AVATAR_MIN_WiDTH;
        $this->min_height = AVATAR_MIN_HEIGHT;
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
                'max:' . $this->size,
                'dimensions:min_width=' . $this->min_width . ',min_height=' . $this->min_height
            ],
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => ':attribute image is required.',
            'avatar.image' => ':attribute should be image file.',
            'avatar.mimes' => ':attribute format should be in these types : ' . $this->mimes,
            'avatar.max' => ':attribute image size should be '.$this->size.' KB',
            'avatar.uploaded' => 'The :attribute failed to upload.',
            'avatar.dimensions' => 'the with and height of image should be '.$this->min_width.'x'.$this->min_height
        ];
    }

}

<?php

namespace App\Http\Requests\Attachment;

use App\Enums\AttachmentTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use const ATTACHMENT_SIZE;

class AttachmentRequest extends FormRequest
{

    public $mimes;
    public $size;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->mimes = join(",", ATTACHMENT_MIMES);
        $this->size = ATTACHMENT_SIZE;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attachment' => [
                'required',
                'nullable',
                'image',
                'mimes:' . $this->mimes,
                'max:' . $this->size,
            ],
            'type' => ['required', Rule::enum(AttachmentTypeEnum::class)]
        ];
    }

    public function messages()
    {
        return [
            'attachment.required' => ':attribute image is required.',
            'attachment.image' => ':attribute should be image file.',
            'attachment.mimes' => ':attribute format should be in these types : ' . $this->mimes,
            'attachment.max' => ':attribute image size should be '.$this->size.' KB',
            'attachment.uploaded' => 'The :attribute failed to upload.',
        ];
    }
}

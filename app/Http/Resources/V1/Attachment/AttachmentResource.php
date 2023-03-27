<?php

namespace App\Http\Resources\V1\Attachment;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{

    public function __construct(Attachment $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array | null
    {
        if($this->resource == null)
            return null;

        return [
            'id_attachment' => $this->id_attachment,
            'url' => $this->url,
            'name' => $this->name,
            'type' => $this->type,
            'extension' => $this->extension,
            'size_b' => (int)$this->size_b,
            'created_at' => $this->created_at,
        ];
    }
}

<?php

namespace App\Http\Resources\V1\Avatar;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvatarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->resource == null)
            return [];

        return [
            'url' => $this->url,
            'id' => $this->id,
            'width' => $this->width,
            'height' => $this->height,
            'created_at' => $this->created_at,
        ];
    }
}

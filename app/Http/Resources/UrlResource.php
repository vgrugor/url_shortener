<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'domain' => $this->domain,
            'attributes' => $this->attributes,
            'shortKey' => $this->short_key,
            'url' => $this->url,
            'secretKey' => $this->secret_key,
            'createdAt' => $this->created_at,
            'validAt' => $this->valid_at,
        ];
    }
}

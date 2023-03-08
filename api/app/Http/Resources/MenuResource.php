<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "title_slug" => $this->slug,
            "address" => $this->address,
            "work_time" => $this->work_time,
            "image" => $this->image,
            "description" => $this->description,
            "phone_primary" => $this->phone_primary,
            "phone_secondary" => $this->phone_secondary,
            "facebook_page_id" => $this->facebook_page_id,
        ];
    }
}

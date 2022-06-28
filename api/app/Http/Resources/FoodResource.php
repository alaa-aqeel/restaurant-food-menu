<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            "name" => $this->name,
            "name_slug" => $this->slug,
            "image" => $this->image,
            "price" => $this->price,
            "description" => $this->description,
            'is_available' => $this->is_available
            // "category" => new CategoryResource($this->category),
        ];
    }
}

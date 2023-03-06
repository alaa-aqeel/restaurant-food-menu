<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            "username" => $this->username,
            "phone" => $this->phone,
            "created_at" => $this->created_at,
            "expire_at" => $this->expire_at->format("Y/m/d"),
            "is_admin" => $this->when($this->is_admin, $this->is_admin),
            "menu" => new MenuResource($this->menu) ,
        ];
    }
}

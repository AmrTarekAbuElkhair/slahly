<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
             'id'               => $this->id,
            'url'              => $this->url!= null ? $this->url : "",
            'image'            => $this->image,
            'type'             => $this->type,
            'offer_id'         => $this->offer_id!= null ? $this->offer_id : 0,
            'package_id'         => $this->package_id!= null ? $this->package_id : 0,
            ];
    }
}

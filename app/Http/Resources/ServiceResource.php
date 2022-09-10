<?php

namespace App\Http\Resources;

use App\Models\ServiceTranslation;
use Illuminate\Http\Resources\Json\JsonResource;


class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang=request()->header('Lang') ? request()->header('Lang') : 'en';
        return [
            'id'               => $this->id,
            'name'             => ServiceTranslation::where('service_id',$this->id)->where('locale',$lang)->first()->name,
            'icon'             => $this->icon,
        ];
    }
}

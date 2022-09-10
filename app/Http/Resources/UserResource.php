<?php

namespace App\Http\Resources;
use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\ServiceTranslation;
use App\Models\TypeTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'             => $this->name,
            'mobile'           => substr($this->mobile, 3,20),
            'email'            => $this->email,
            'lat'              => $this->lat,
            'lng'              => $this->lng,
            'address'          => $this->address,
            'verified_status'  => $this->verified_status == 1 ? true : false,
            'status'           => $this->status == 1 ? true : false,
            'image'            => $this->image,
            'country_id'       => $this ->country_id,
            'country_name'     => CountryTranslation::where('country_id',$this->country_id)->where('locale',$lang)->first()->name,
            'city'             => $this ->city,
            'access_token'     => $request->bearerToken() != null ? $request->bearerToken() : $this->createToken('access_token')->plainTextToken,
        ];
    }
}

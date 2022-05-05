<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->user->name,
            'logo' => $this->logo_path,
            'category_id' => $this->category->id,
            'location' =>  $this->location,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'work_time' => $this->user->workTimes,
            'services' => $this->user->services->take(4),
        ];
      //  return parent::toArray($request);
    }
}

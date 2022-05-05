<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'image' => $this->image_path,

        ];

        if ($request->server('HTTP_ACCEPT_LANGUAGE') == 'ar') {
           $data['name'] = $this->name_ar;
        } else {
            $data['name'] = $this->name_en;
        }

      /*   $data['shops']=[
           $this->shops
        ]; */
        
        return $data;
       // return parent::toArray($request);
    }
}

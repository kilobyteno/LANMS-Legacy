<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'postalcode' => $this->postalcode,
            'city' => $this->city,
            'county' => $this->county,
            'country' => $this->country,
            'main_address' => $this->main_address,
        ];
    }
}

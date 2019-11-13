<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LANMS\Http\Resources\Address as AddressResource;
use LANMS\Http\Resources\Reservation as ReservationResource;

class User extends JsonResource
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
            'email' => $this->email,
            'username' => $this->username,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'birthdate' => $this->birthdate,
            'age' => (int)$this->age(),
            'phone' => $this->phone,
            'addresses' => AddressResource::collection($this->addresses),
            'ownReservationsThisYear' => ReservationResource::collection($this->ownReservationsThisYear),
        ];
    }
}

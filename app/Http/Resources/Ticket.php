<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LANMS\Http\Resources\Checkin as CheckinResource;

class Ticket extends JsonResource
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
            'barcode' => $this->barcode,
            'reservation_id' => $this->reservation_id,
            'user_id' => $this->user_id,
            'checkin_id' => $this->checkin_id,
            'year' => $this->year,
            'checkin' => new CheckinResource($this->checkin),
        ];
    }
}

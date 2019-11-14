<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Checkin extends JsonResource
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
            'ticket_id' => $this->ticket_id,
            'bandnumber' => $this->bandnumber,
            'year' => $this->year,
        ];
    }
}

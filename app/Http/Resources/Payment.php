<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
            'stripecharge' => $this->stripecharge,
            'user_id' => $this->user_id,
            'reservation_id' => $this->reservation_id,
        ];
    }
}

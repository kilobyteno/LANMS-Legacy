<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LANMS\Http\Resources\Row as RowResource;

class Seat extends JsonResource
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
            'name' => $this->name,
            'row' => new RowResource($this->row),
        ];
    }
}

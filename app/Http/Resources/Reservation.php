<?php

namespace LANMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LANMS\Http\Resources\Seat as SeatResource;
use LANMS\Http\Resources\Ticket as TicketResource;
use LANMS\Http\Resources\Payment as PaymentResource;
use LANMS\Http\Resources\ReservationStatus;

class Reservation extends JsonResource
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
            'seat' => new SeatResource($this->seat),
            'reservedby_id' => $this->reservedby_id,
            'reservedfor_id' => $this->reservedfor_id,
            'payment' => new PaymentResource($this->payment),
            'ticket' => new TicketResource($this->ticket),
            'status' => new ReservationStatus($this->status),
            'year' => $this->year,
            'reminder_email_sent' => $this->reminder_email_sent,
        ];
    }
}

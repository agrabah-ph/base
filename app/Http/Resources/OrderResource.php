<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'description' => $this->note,
            'bid_end_date' => $this->bid_end_date,
            'items' => $this->items,
            'user' => $this->user,
            'bids' => $this->bids
        ];
    }
}

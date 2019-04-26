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
            'description' => $this->description,
            'bid_end_date' => strtotime($this->bid_end_date),
            'items' => $this->items,
            'user' => $this->user,
            'bids' => $this->bids,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'total' => (float) $this->total,
            'created_at' => (string) $this->created_at,
            'currency' => new Currency($this->whenLoaded('currency')),
        ];
    }
}

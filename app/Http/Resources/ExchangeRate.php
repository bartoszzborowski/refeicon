<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeRate extends JsonResource
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
            'mid' => $this->resource['mid'],
            'bid' => $this->resource['bid'],
            'ask' => $this->resource['ask'],
        ];
    }
}

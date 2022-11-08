<?php

declare(strict_types=1);

namespace App\Http\Resources;

class LocationResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    public function toArray($request): array
    {
        return [
            'zip' => $this->resource->zip,
            'name' => $this->resource->location,
            'lat' => $this->resource->lat,
            'lon' => $this->resource->lon,
            'distance' => ($this->resource->distance > 0) ? $this->resource->distance : 0
        ];
    }
}

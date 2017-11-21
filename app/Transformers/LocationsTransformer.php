<?php

namespace App\Http\Transformers;


use App\Models\Location;
use League\Fractal\TransformerAbstract;

class LocationsTransformer extends TransformerAbstract
{

    public function transform(Location $location)
    {
        return [
            'zip' => $location->zip,
            'name' => $location->location,
            'lat' => $location->lat,
            'lon' => $location->lon,
            'distance' => ($location->distance > 0) ? $location->distance : 0
        ];
    }
}
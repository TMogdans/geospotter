<?php

namespace App\Http\Controllers;


use App\Http\Transformers\LocationsTransformer;
use App\Models\Location;
use App\Services\TransformerService;
use Illuminate\Http\Request;

class LocationController extends ApiController
{

    public function findNearby(Request $request)
    {
        $locations = Location::distance(floatval($request->lat), floatval($request->lon), doubleval($request->radius),
            $request->unit)->get();

        if ($locations->count() == 0) {
            return $this->respondNotFound();
        }

        return $this->response(TransformerService::transform($locations, new LocationsTransformer()));
    }

    public function findByZip($zip)
    {
        $locations = Location::byZip($zip)->get();

        if ($locations->count() == 0) {
            return $this->respondNotFound();
        }

        return $this->response(TransformerService::transform($locations, new LocationsTransformer()));
    }

    public function findByName($name)
    {
        $locations = Location::byName(urldecode($name))->get();

        if ($locations->count() == 0) {
            return $this->respondNotFound();
        }

        return $this->response(TransformerService::transform($locations, new LocationsTransformer()));
    }
}
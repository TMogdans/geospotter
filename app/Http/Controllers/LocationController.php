<?php

namespace App\Http\Controllers;


use App\Http\Transformers\LocationsTransformer;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function findNearby(Request $request)
    {
        $locations = Location::distance(floatval($request->lat), floatval($request->lon), doubleval($request->radius),
            $request->unit)->get();

        return fractal($locations, new LocationsTransformer())->toJson();
    }

    public function findByZip($zip)
    {
        $locations = Location::byZip($zip)->get();

        return fractal($locations, new LocationsTransformer())->toJson();
    }

    public function findByName($name)
    {
        $locations = Location::byName($name)->get();

        return fractal($locations, new LocationsTransformer())->toJson();
    }
}
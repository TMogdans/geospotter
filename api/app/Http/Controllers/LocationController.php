<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use TMogdans\JsonApiProblemResponder\Exceptions\BadRequestException;

class LocationController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     * @throws BadRequestException
     */
    public function findNearby(Request $request): AnonymousResourceCollection
    {
        try {
            $locations = Location::distance(
                (float) $request->lat,
                (float) $request->lon,
                (float) $request->radius,
                $request->unit
            )->get();
        } catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage());
        }

        return LocationResource::collection($locations);
    }

    /**
     * @param $zip
     * @return AnonymousResourceCollection
     * @throws BadRequestException
     */
    public function findByZip($zip): AnonymousResourceCollection
    {
        try {
            $locations = Location::byZip($zip)->get();
        } catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage());
        }

        return LocationResource::collection($locations);
    }

    /**
     * @param $name
     * @return AnonymousResourceCollection
     * @throws BadRequestException
     */
    public function findByName($name): AnonymousResourceCollection
    {
        try {
            /** @var Collection $locations */
            $locations = Location::byName(urldecode($name))->get();
        } catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage());
        }

        return LocationResource::collection($locations);
    }
}

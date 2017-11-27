<?php

namespace App\Services;


use League\Fractal\TransformerAbstract;
use Spatie\Fractalistic\ArraySerializer;

class TransformerService
{
    public static function transform(
        $data,
        TransformerAbstract $transformer,
        array $includes = [],
        array $excludes = []
    ) {
        return fractal($data)
            ->transformWith($transformer)
            ->parseIncludes($includes)
            ->parseExcludes($excludes)
            ->serializeWith(new ArraySerializer());
    }
}
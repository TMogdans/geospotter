<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{

    protected $attributes = [
        'loc_id',
        'zip',
        'location',
        'lat',
        'lon'
    ];

    protected $table = 'zip_coordinates';

    public $timestamps = false;

    public function scopeByZip($query, $zip)
    {
        $query->where('zip', 'like', "%$zip%");
    }

    public function scopeByName($query, $name)
    {
        $query->where('location', 'like', "$name%");
    }

    public function scopeDistance($query, $lat, $lon, $radius, $unit)
    {
        $unit = ($unit === "km") ? 6378.10 : 3963.17;

        return $query->having('distance', '<=', $radius)->select(DB::raw("*, ($unit * ACOS(COS(RADIANS($lat))
                                        * COS(RADIANS(lat))
                                        * COS(RADIANS($lon) - RADIANS(lon))
                                        + SIN(RADIANS($lat))
                                        * SIN(RADIANS(lat)))) AS distance")
        )->orderBy('distance', 'asc');
    }
}
<?php
namespace App\Services;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Arr;
use Auth;
use Config;

class AttendanceService
{
    // Employee Distance From Office
    public static function employeeDistanceFromOffice($latitudeFrom,$longitudeFrom)
    {
        $shop_id = auth()->user()->shop_id;
        $shop = Shop::find($shop_id);
        $latitudeTo = null;
        $longitudeTo = null;
        if($shop){
            $latitudeTo = $shop->lat;
            $longitudeTo = $shop->long;
        }        
        return self::vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Vincenty formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    public static function vincentyGreatCircleDistance($latitudeFrom,$longitudeFrom,$latitudeTo,$longitudeTo,$earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
    
        $lonDelta = $lonTo - $lonFrom;

        $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
    
        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }
}
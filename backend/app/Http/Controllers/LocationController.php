<?php

namespace App\Http\Controllers;

use App\Services\GeocodingService;
use Illuminate\Routing\Controller;

class LocationController extends Controller
{
    protected $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    public function getCoordinatesFromAddress($address)
    {
        $coordinates = $this->geocodingService->getCoordinates($address);
        
        if ($coordinates) {
            return response()->json($coordinates);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
}

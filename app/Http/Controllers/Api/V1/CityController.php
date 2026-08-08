<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * Show a single active city.
     */
    public function show(City $city): JsonResponse
    {
        if (! $city->is_active || ! $city->governorate?->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.',
            ], 404);
        }

        $city->load('governorate');

        return response()->json([
            'success' => true,
            'data' => new CityResource($city),
        ]);
    }
}

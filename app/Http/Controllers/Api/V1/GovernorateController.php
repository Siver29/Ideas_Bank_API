<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\GovernorateResource;
use App\Models\Governorate;
use Illuminate\Http\JsonResponse;

class GovernorateController extends Controller
{
    /**
     * List active governorates.
     */
    public function index(): JsonResponse
    {
        $governorates = Governorate::query()
            ->where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => GovernorateResource::collection($governorates),
        ]);
    }

    /**
     * Show a single active governorate.
     */
    public function show(Governorate $governorate): JsonResponse
    {
        if (! $governorate->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new GovernorateResource($governorate),
        ]);
    }

    /**
     * List the active cities belonging to a governorate.
     */
    public function cities(Governorate $governorate): JsonResponse
    {
        if (! $governorate->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.',
            ], 404);
        }

        $cities = $governorate->cities()
            ->where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => CityResource::collection($cities),
        ]);
    }
}

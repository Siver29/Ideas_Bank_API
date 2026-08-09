<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MachineryResource;
use App\Models\Machinery;
use Illuminate\Http\JsonResponse;

class MachineryController extends Controller
{
    /**
     * List all machinery in the equipment catalogue.
     */
    public function index(): JsonResponse
    {
        $machinery = Machinery::query()
            ->orderBy('name_en', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => MachineryResource::collection($machinery),
        ]);
    }

    /**
     * Show a single piece of machinery.
     */
    public function show(Machinery $machinery): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new MachineryResource($machinery),
        ]);
    }
}

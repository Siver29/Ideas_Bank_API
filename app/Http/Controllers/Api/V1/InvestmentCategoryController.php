<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvestmentCategoryResource;
use App\Models\InvestmentCategory;
use Illuminate\Http\JsonResponse;

class InvestmentCategoryController extends Controller
{
    /**
     * List active investment categories.
     */
    public function index(): JsonResponse
    {
        $categories = InvestmentCategory::query()
            ->where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => InvestmentCategoryResource::collection($categories),
        ]);
    }

    /**
     * Show a single active investment category.
     */
    public function show(InvestmentCategory $investmentCategory): JsonResponse
    {
        if (! $investmentCategory->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new InvestmentCategoryResource($investmentCategory),
        ]);
    }
}

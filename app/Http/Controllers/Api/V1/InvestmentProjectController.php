<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvestmentProjectResource;
use App\Http\Resources\InvestmentProjectSummaryResource;
use App\Models\InvestmentProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvestmentProjectController extends Controller
{
    /**
     * List all active investment projects.
     *
     * The frontend performs search, filtering, sorting, and pagination
     * locally, so this endpoint accepts no query parameters.
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->query->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Search, filtering, sorting, and pagination are handled by the frontend. This endpoint does not accept query parameters.',
                'errors' => [
                    'query' => [
                        'Unsupported query parameters were provided.',
                    ],
                ],
            ], 422);
        }

        $projects = InvestmentProject::query()
            ->where('is_active', true)
            ->whereHas('investmentCategory', fn ($q) => $q->where('is_active', true))
            ->whereHas('governorate', fn ($q) => $q->where('is_active', true))
            ->whereHas('city', fn ($q) => $q->where('is_active', true))
            ->with(['investmentCategory', 'governorate', 'city', 'machinery'])
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => InvestmentProjectSummaryResource::collection($projects),
        ]);
    }

    /**
     * Show a single active investment project.
     */
    public function show(InvestmentProject $investmentProject): JsonResponse
    {
        if (! $investmentProject->is_active
            || ! $investmentProject->investmentCategory?->is_active
            || ! $investmentProject->governorate?->is_active
            || ! $investmentProject->city?->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.',
            ], 404);
        }

        $investmentProject->load(['investmentCategory', 'governorate', 'city', 'machinery']);

        return response()->json([
            'success' => true,
            'data' => new InvestmentProjectResource($investmentProject),
        ]);
    }
}

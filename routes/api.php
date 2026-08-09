<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\GovernorateController;
use App\Http\Controllers\Api\V1\InvestmentCategoryController;
use App\Http\Controllers\Api\V1\InvestmentProjectController;
use App\Http\Controllers\Api\V1\MachineryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This is the public REST API for the Syrian Investment Ideas Bank.
|
| All routes are versioned under /api/v1. The frontend receives the
| complete active dataset and performs search, filtering, sorting, and
| pagination locally, so these endpoints intentionally expose no query
| parameters and require no authentication.
|
*/

Route::prefix('v1')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Investment Projects
    |--------------------------------------------------------------------------
    */

    Route::get('investment-projects', [InvestmentProjectController::class, 'index']);
    Route::get('investment-projects/{investmentProject}', [InvestmentProjectController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Investment Categories
    |--------------------------------------------------------------------------
    */

    Route::get('investment-categories', [InvestmentCategoryController::class, 'index']);
    Route::get('investment-categories/{investmentCategory}', [InvestmentCategoryController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Governorates & Cities
    |--------------------------------------------------------------------------
    */

    Route::get('governorates', [GovernorateController::class, 'index']);
    Route::get('governorates/{governorate}', [GovernorateController::class, 'show']);
    Route::get('governorates/{governorate}/cities', [GovernorateController::class, 'cities']);

    /*
    |--------------------------------------------------------------------------
    | Cities
    |--------------------------------------------------------------------------
    */

    Route::get('cities', [CityController::class, 'index']);
    Route::get('cities/{city}', [CityController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Machinery
    |--------------------------------------------------------------------------
    */

    Route::get('machinery', [MachineryController::class, 'index']);
    Route::get('machinery/{machinery}', [MachineryController::class, 'show']);
});

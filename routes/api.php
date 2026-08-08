<?php

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
    | Investment Project Endpoints (added in a later phase)
    |--------------------------------------------------------------------------
    |
    | The investment-project domain (projects, categories, governorates,
    | and cities) will be registered here in the next phase.
    |
    */
});

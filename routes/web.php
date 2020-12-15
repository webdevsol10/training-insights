<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsightsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'instagram'], function () {
    Route::get('/{handle}', [InsightsController::class, 'accountInsights']);
    Route::get('/{handle}/content/insights', [InsightsController::class, 'contentInsights']);
    Route::get('/{handle}/content/metrics', [InsightsController::class, 'contentMetrics']);
});

<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('experiences', [ApiController::class, 'experiences']);
Route::get('skills', [ApiController::class, 'skills']);
Route::get('portfolios', [ApiController::class, 'portfolios']);
Route::get('portfolios/{id}', [ApiController::class, 'detailPortfolio']);

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('login', [AuthController::class, 'loginView'])->name('loginView');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('experiences', [PageController::class, 'experiences'])->name('experiences');
    Route::get('skills', [PageController::class, 'skills'])->name('skills');
    Route::get('portfolio', [PageController::class, 'portfolio'])->name('portfolio');
    Route::get('detail-portfolio/{id}', [PageController::class, 'detailPortfolio'])->name('detail.portfolio');
    Route::get('create-portfolio', [PageController::class, 'createPortfolio'])->name('create.portfolio');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('skills', [SkillController::class, 'store'])->name('create.skills');
    Route::get('skills/{id}', [SkillController::class, 'detailSkill'])->name('detail.skills');
    Route::put('skills/{id}', [SkillController::class, 'updateSkill'])->name('update.skills');
    Route::delete('skills/{id}', [SkillController::class, 'deleteSkill'])->name('delete.skills');
    Route::post('experiences', [ExperienceController::class, 'createExperiences'])->name('create.experiences');
    Route::get('experiences/{id}', [ExperienceController::class, 'detailExperiences'])->name('detail.experiences');
    Route::delete('experiences/{id}', [ExperienceController::class, 'deleteExperiences'])->name('delete.experiences');
    Route::put('experiences/{id}', [ExperienceController::class, 'updateExperiences'])->name('update.experiences');

    Route::post('portfolio', [PortfolioController::class, 'addPortfolio'])->name('store.portfolio');
    Route::delete('portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('delete.portfolio');
    Route::put('portfolio', [PortfolioController::class, 'updatePortfolio'])->name('update.portfolio');
    Route::get('portfolio-images', [PageController::class, 'getImagesPortfolio'])->name('get.portfolio-images');
    Route::post('upload', [FileController::class, 'upload'])->name('upload.files');
    Route::post('delete-image', [FileController::class, 'deleteImage'])->name('delete.files');
});

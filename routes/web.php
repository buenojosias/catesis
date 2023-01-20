<?php

use App\Http\Controllers\CatechistController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KinshipController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/perfil', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [UserProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:community_show')->group(function() {
        Route::get('/comunidades', [CommunityController::class, 'index'])->name('communities.index');
        Route::get('/comunidades/{community}', [CommunityController::class, 'show'])->name('communities.show');
        Route::get('/comunidades/{community}/editar', [CommunityController::class, 'edit'])->name('communities.edit');
    });

    Route::get('/catequistas', [CatechistController::class, 'index'])->name('catechists.index');
    Route::get('/catequistas/cadastro', [CatechistController::class, 'create'])->middleware('can:user_create')->name('catechists.create');
    Route::get('/catequistas/{user}', [CatechistController::class, 'show'])->name('catechists.show');

    Route::get('/etapas', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/etapas/{grade}', [GradeController::class, 'show'])->name('grades.show');

    Route::get('/grupos', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/grupos/{group}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/grupos/{group}/encontro-{encounter}', [GroupController::class, 'encounter'])->name('groups.encounter');

    Route::get('/catequizandos', [StudentController::class, 'index'])->name('students.index');
    Route::get('/catequizandos/cadastro', [StudentController::class, 'create'])->middleware('can:student_create')->name('students.create');
    Route::get('/catequizandos/{student}/{section?}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/catequizandos/{student}/editar', [StudentController::class, 'edit'])->middleware('can:student_edit')->name('students.edit');

    Route::get('/familiares/{kinship}', [KinshipController::class, 'show'])->name('kinships.show');
});

require __DIR__.'/auth.php';

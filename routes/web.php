<?php

use App\Http\Controllers\CatechistController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EncounterController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KinshipController;
use App\Http\Controllers\ParishController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Livewire\Event\Index as Event;
use App\Http\Livewire\Group\PrintableAttendance;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Inscription\Index as Inscription;

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

    Route::middleware('role:super-admin')->group(function () {
        Route::get('/paroquias', [ParishController::class, 'index'])->name('parishes.index');
        Route::get('/paroquias/{parish}', [ParishController::class, 'show'])->name('parishes.show');
    });

    Route::middleware('can:communities_show')->group(function () {
        Route::get('/comunidades', [CommunityController::class, 'index'])->name('communities.index');
        Route::get('/comunidades/{community}', [CommunityController::class, 'show'])->name('communities.show');
        Route::get('/comunidades/{community}/editar', [CommunityController::class, 'edit'])->name('communities.edit');
    });

    Route::get('/catequistas', [CatechistController::class, 'index'])->name('catechists.index');
    Route::get('/catequistas/cadastro', [CatechistController::class, 'create'])->name('catechists.create');
    Route::get('/catequistas/{user}/{section?}', [CatechistController::class, 'show'])->name('catechists.show');

    Route::get('/etapas', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/etapas/{grade}', [GradeController::class, 'show'])->name('grades.show');

    Route::get('/grupos', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/grupos/{group}/imprimir', [GroupController::class, 'printCard'])->name('group.print');
    Route::get(
        '/grupos/{group}/chamada',
        function ($group) {
            $group = \App\Models\Group::findOrFail($group);
        return view('groups.printable-attendance', ['group' => $group]);
    }
    )->name('groups.printableattendance');
    Route::get('/grupos/{group}/encontro-{encounter}', [GroupController::class, 'encounter'])->name('groups.encounter');
    Route::get('/grupos/{group}/{section?}', [GroupController::class, 'show'])->name('groups.show');

    Route::get('/encontros/{section?}', [EncounterController::class, 'index'])->name('encounters.index');

    Route::get('/catequizandos', [StudentController::class, 'index'])->name('students.index');
    Route::get('/catequizandos/cadastro', [StudentController::class, 'create'])->middleware('can:student_create')->name('students.create');
    Route::get('/catequizandos/{student}/transferencia-{transfer}', [StudentController::class, 'printTransfer'])->name('student.transfer.print');
    Route::get('/catequizandos/{student}/imprimir', [StudentController::class, 'printCard'])->name('student.print');
    Route::get('/catequizandos/{student}/{section?}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/inscricoes/{code?}', EnrollmentController::class)->middleware('can:student_edit')->name('enrollments');

    Route::get('/familiares', [KinshipController::class, 'index'])->name('kinships.index');
    Route::get('/familiares/{kinship}', [KinshipController::class, 'show'])->name('kinships.show');

    Route::get('/pastorais/{list?}', App\Http\Livewire\Pastoral\Index::class)->name('pastorals.index');

    Route::get('/eventos/{section?}', Event::class)->name('events.index');
});

Route::get('/inscricao', Inscription::class)->name('inscription');

require __DIR__ . '/auth.php';

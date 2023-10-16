<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController as GuestProjectController;
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

Route::get('/', function () {
    return view('guests.welcome');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//raggruppo le route per renderle accessibili
//solo a chi è verificato ed ha accesso alla zona admin
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        //projects reader
        Route::get('/projects', [ProjectController::class, "index"])->name("projects.index");
        Route::get('/projects/{slug}]', [ProjectController::class, "show"])->name("projects.show");

        //project creater
        Route::post('/projects', [ProjectController::class, "store"])->name("projects.store");
        Route::get('/projects/create', [ProjectController::class, "create"])->name("projects.create");

        //update
        Route::get('/projects/{slug}/edit', [ProjectController::class, "edit"])->name("projects.edit");
        Route::put("/projects/{project}", [ProjectController::class, "update"])->name("projects.update");
   
        //delete
        Route::delete("/projects/{id}", [ProjectController::class, "destroy"])->name("projects.destroy");
    });


Route::get("/projects", [GuestProjectController::class, "index"])->name("projects.index");



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

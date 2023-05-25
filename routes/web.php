<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TypeController;



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


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // route to dashboard
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');
    //route to projects (aggiungiamo il parametro slug e non più l'id)
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
    // route to types
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// every admin route must have the prefix 'admin/' in the URL
// the route name must start with 'admin. '
/*
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projects',  ProjectController::class)->parameters(['projects' => 'project:slug']);
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');
    // edit, update, delete
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

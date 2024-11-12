<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


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
    return redirect('login');  // Redirect root to login page
});

// Authenticated user profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar/update', [ProfileController::class, 'updateAvatar'])->name('avatar.update');
    Route::post('/profile/avatar/remove', [ProfileController::class, 'removeAvatar'])->name('avatar.remove');
    Route::delete('/user/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route for main dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//route for anime dashboard
Route::get('/anime', function () {
    return view('anime');
})->name('anime');

//route for marketpalce dashboard
Route::get('/marketdash', function () {
    return view('marketdash');
})->name('marketdash');



require __DIR__.'/auth.php';

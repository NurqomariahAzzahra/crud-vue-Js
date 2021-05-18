<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth:sanctum', 'verified']);
Route::get('/dasboard', [HomeController::class, 'dasboard'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);

Route::get('vue/{any}', function () {
    return view('app');
})->where('any', '.*')->middleware(['auth']);

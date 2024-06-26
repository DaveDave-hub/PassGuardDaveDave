<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

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
    $installed = Storage::disk('public')->exists('installed');
    if (!$installed) {
        Artisan::call('migrate');
        Storage::disk('public')->put('installed', 'Contents');
    }
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('vault', [App\Http\Controllers\PassController::class, 'index'])->name('vault.index');
    Route::post('vault/store', [App\Http\Controllers\PassController::class, 'store'])->name('vault.store');
    Route::put('vault/update/{id}', [App\Http\Controllers\PassController::class, 'update'])->name('vault.update');
    Route::delete('vault/destroy/{id}', [App\Http\Controllers\PassController::class, 'destroy'])->name('vault.destroy');
    Route::get('vault/search', [App\Http\Controllers\PassController::class, 'search'])->name('vault.search');
    Route::get('vault/edit/{id}', [App\Http\Controllers\PassController::class, 'edit'])->name('vault.edit');




    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/change', [App\Http\Controllers\HomeController::class, 'changePass'])->name('changePass');
});

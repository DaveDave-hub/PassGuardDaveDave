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
    if(!$installed){
        Artisan::call('migrate');
        Storage::disk('public')->put('installed', 'Contents');
    }
    return view('welcome');
});

Auth::routes();

Route::put('vault/update', [App\Http\Controllers\PassController::class, 'update'])->name('vault.update')->middleware('auth');;
Route::get('vault', [App\Http\Controllers\PassController::class, 'index'])->name('vault.index')->middleware('auth');;
Route::post('vault/store', [App\Http\Controllers\PassController::class, 'store'])->name('vault.store')->middleware('auth');;
Route::delete('vault/destroy/{id}', [App\Http\Controllers\PassController::class, 'destroy'])->name('vault.destroy')->middleware('auth');;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile/change', [App\Http\Controllers\HomeController::class, 'changePass'])->name('changePass')->middleware('auth');


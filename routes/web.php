<?php

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

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::get('/login', function() {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function() {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::resource('employees', \App\Http\Controllers\EmployeController::class)->except(['show']);
    Route::resource('positions', \App\Http\Controllers\PositionController::class)->except(['show']);
});

Route::post('employees-datatable', \App\Http\Controllers\Ajax\EmployeeDataTableContoller::class)->name('employees-datatable');


Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');

Route::post('logout',[\App\Http\Controllers\Auth\AuthController::class, 'logout'])->middleware('auth')->name('logout');

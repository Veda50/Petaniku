<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
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

// Admin Route
Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminController::class, 'index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class, 'register'])->name('register_form');
    Route::post('/register/create',[AdminController::class, 'create'])->name('admin.register');
});

// User Route
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Guest Route
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/farmpedia', function () {
    return view('farmpedia');
})->name('farmpedia');

Route::get('/farmpedia-detail', function () {
    return view('farmpedia-detail');
})->name('farmpedia-detail');

Route::get('/workflow', function () {
    return view('workflow');
})->name('workflow');

Route::get('/workflow-detail', function () {
    return view('workflow-detail');
})->name('workflow-detail');
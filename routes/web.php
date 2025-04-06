<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthenticationController;
use App\Policies\TaskPolicy;

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
    return view('welcome');
});
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index')->middleware('isLoggedIn');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create')->middleware('isLoggedIn');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store')->middleware('isLoggedIn');
Route::get('/tasks/{task}', [TaskController::class, 'edit'])->name('tasks.edit')->middleware('isLoggedIn');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update')->middleware('isLoggedIn');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware('isLoggedIn');
Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete')->middleware('isLoggedIn');
Route::get('/taskshow', [TaskController::class, 'showCompleted'])->name('tasks.taskshow')->middleware('isLoggedIn');

Route::controller(AuthenticationController::class)->group(function(){
    Route::get('/registration','registration')->middleware('alreadyLoggedIn');
    Route::post('/registration-user','registerUser')->name('register-user');
    Route::get('/login','login')->middleware('alreadyLoggedIn');
    Route::post('/login-user','loginUser')->name('login-user');
    Route::get('/logout','logout')->name('auth.logout');
});
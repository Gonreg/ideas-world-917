<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', [UserController::class, 'showIdeas'])->name('index');
Route::post('/add-idea', [UserController::class, 'addIdea']);
Route::post('/add-like', [UserController::class, 'addLike']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('/admin')->group(function () {
    Route::get('/', function () {return view('admin.index');})->middleware('auth');

    Route::get('/ideas-list', [AdminController::class, 'ideasList'])->middleware('auth');

    Route::get('/categories-list', [AdminController::class, 'categoriesList'])->middleware('auth');
    Route::get('/add-new-idea', [AdminController::class, 'addNewIdea'])->middleware('auth');
    Route::get('/add-new-category', function () {return view('admin.addNewCategory');})
        ->middleware('auth');

    Route::post('/save-new-category', [AdminController::class, 'saveNewCategory'])->middleware('auth');
    Route::post('/save-new-idea', [AdminController::class, 'saveNewIdea'])->middleware('auth');


    Route::get('/delete-idea', [AdminController::class, 'deleteIdea'])->middleware('auth');
    Route::get('/delete-category', [AdminController::class, 'deleteCategory'])->middleware('auth');

    Route::get('/update-idea', [AdminController::class, 'updateIdea'])->middleware('auth');
    Route::post('/save-updated-idea', [AdminController::class, 'saveUpdatedIdea'])->middleware('auth');

    Route::get('/update-category', [AdminController::class, 'updateCategory'])->middleware('auth');
    Route::post('/save-updated-category', [AdminController::class, 'saveUpdatedCategory'])->middleware('auth');
});

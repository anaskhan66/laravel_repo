<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->name('welcome');

Auth::routes();
Route::middleware('isAdmin')->group(function(){
    
    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');
    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.list');
    Route::get('/treeView', [App\Http\Controllers\Admin\CategoryController::class, 'treeView'])->name('treeView.list');
    Route::any('/addCategory', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.add');
    Route::any('/deleteCategory',[App\Http\Controllers\Admin\CategoryController::class,'Delete']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


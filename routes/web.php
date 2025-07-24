<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

 

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard',[AdminDashboardController::class ,'index'])->name('dashboard.index');
 });
  Route::get('products',[ProductController::class ,'index'])->name('product.index');
  Route::get('products/create',[ProductController::class ,'create'])->name('product.create');
  Route::post('products/store',[ProductController::class ,'store'])->name('product.store');
  Route::get('products/{product}/edit',[ProductController::class ,'edit'])->name('product.edit');
  Route::put('products/{product}/update',[ProductController::class ,'update'])->name('product.update');

  Route::get('clients',[ClientController::class ,'index'])->name('client.index');
  Route::get('clients/create',[ClientController::class ,'create'])->name('client.create');
  Route::get('clients/{client}/edit',[ClientController::class ,'edit'])->name('client.edit');
  Route::put('clients/{client}/update',[ClientController::class ,'update'])->name('client.update');

  Route::post('clients/store',[ClientController::class ,'store'])->name('client.store');
Route::delete('clients/{client}/delete',[ClientController::class ,'delete'])->name('client.destroy');

Route::post('/pass-command/{client}',[CommandController::class , 'passCommand'])->name('pass.command');
Route::get('/commands/today',[CommandController::class ,'history'])->name('command.today');
require __DIR__.'/auth.php';

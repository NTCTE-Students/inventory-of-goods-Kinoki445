<?php

use App\Http\Controllers\SupplyController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SupplyController::class, 'index'])->name('supplies.index');
Route::get('/create', [SupplyController::class, 'create'])->name('supplies.create');
Route::post('/', [SupplyController::class, 'store'])->name('supplies.store');
Route::get('/{supply}/edit', [SupplyController::class, 'edit'])->name('supplies.edit');
Route::put('/{supply}', [SupplyController::class, 'update'])->name('supplies.update');

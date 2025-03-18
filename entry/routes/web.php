<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'getByStatus'])->name('index');
Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');

Route::get('/pet/{id}/show', [PetController::class, 'show'])->name('pet.show');
Route::post('/pet', [PetController::class, 'store'])->name('pet.store');

Route::get('/pet/{id}/edit', [PetController::class, 'edit'])->name('pet.edit');
Route::put('/pet/{id}', [PetController::class, 'update'])->name('pet.update');

Route::delete('/pet/{id}', [PetController::class, 'delete'])->name('pet.delete');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'getByStatus'])->name('index');
Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');

Route::get('/pet/{id}', [PetController::class, 'show'])->name('pet.show');
Route::post('/pet', [PetController::class, 'store'])->name('pet.store');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'getByStatus'])->name('index');
Route::get('/pet/{id}', [PetController::class, 'show'])->name('pet.show');

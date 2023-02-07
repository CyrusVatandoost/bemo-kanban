<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::post('/columns', [ColumnController::class, 'store'])->name('columns.store');

Route::post('/cards', [CardController::class, 'store'])->name('cards.store');

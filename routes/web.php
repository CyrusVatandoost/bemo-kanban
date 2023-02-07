<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::post('/columns', [ColumnController::class, 'store'])->name('columns.store');

Route::delete('/columns/{column}', [ColumnController::class, 'destroy'])->name('columns.destroy');

Route::post('/cards', [CardController::class, 'store'])->name('cards.store');

Route::put('/cards/{card}', [CardController::class, 'update'])->name('cards.update');

Route::post('/cards/add', [CardController::class, 'add'])->name('cards.add');

Route::post('/cards/order', [CardController::class, 'updateOrder'])->name('cards.order');

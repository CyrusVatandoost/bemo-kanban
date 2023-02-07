<?php

use App\Http\Controllers\ColumnController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::post('/columns', [ColumnController::class, 'store'])->name('columns.store');

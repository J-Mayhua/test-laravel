<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Redirección simple para cumplir con el requisito de /api/docs
Route::redirect('/api/docs', '/api/documentation');

// Rutas de recursos (CRUD completo)
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

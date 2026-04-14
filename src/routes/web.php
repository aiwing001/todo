<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

Route::get('/', [TodoController::class,'index'])->name('todos.index');
Route::post('/todos', [TodoController::class,'store'])->name('todos.store');
Route::patch('/todos/{id}', [TodoController::class,'update'])->name('todos.update');
Route::delete('/todos/{id}', [TodoController::class,'destroy'])->name('todos.destroy');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class,'store']);
Route::patch('/categories/{id}',[CategoryController::class, 'update']);
Route::delete('/categories/{id}',[CategoryController::class, 'destroy']);
Route::get('/todos/search', [TodoController::class, 'search'])->name('todos.search');

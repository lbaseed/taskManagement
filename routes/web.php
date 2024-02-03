<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class, 'index']);
Route::get('/create', [TaskController::class, 'create'])->name("create_task_view");
Route::post('/create', [TaskController::class, 'store'])->name("store_task");
Route::get('/{id}/show', [TaskController::class, 'show'])->name("show_task");
Route::get('/{id}/edit', [TaskController::class, 'edit'])->name("edit_task");
Route::put('/update', [TaskController::class, 'update'])->name("update_task");
Route::get('/{id}/delete', [TaskController::class, 'destroy'])->name("delete_task");
Route::post('/task_order_change', [TaskController::class, 'taskOrderChange'])->name("task.orderChange");

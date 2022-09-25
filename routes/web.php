<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::resource('task_statuses', TaskStatusController::class);
//->except([
//    'create', 'edit', 'update', 'destroy'
//]);

Route::resource('tasks', TaskController::class);

require __DIR__ . '/auth.php';

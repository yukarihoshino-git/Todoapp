<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/',  [HomeController::class,'index'])->name('home');

    Route::get('/folders/create', [FolderController::class,'showCreateForm'])->name('folders.create');
    Route::post('/folders/create',  [FolderController::class,'create']);

Route::group(['middleware' => 'can:view,folder'], function() {
    Route::get('/folders/{folder}/tasks', [TaskController::class,'index'])->name('tasks.index');

    // Route::get('/folders/{id}/tasks', [TaskController::class,'index'])->name('tasks.index');
    // Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');



    Route::get('/folders/{folder}/tasks/create',  [TaskController::class,'showCreateForm'])->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create',  [TaskController::class,'create']);

    Route::get('/folders/{folder}/tasks/{task}/edit', [TaskController::class,'showEditForm'])->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit',[TaskController::class,'edit']);
});

});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LifeController;

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


Route::get('/', [InfoController::class, 'index'])->name('info.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/life', [LifeController::class, 'index'])->name('life.index');

Route::get('/get', [InfoController::class, 'get']);
Route::get('/test', [InfoController::class, 'currency']);

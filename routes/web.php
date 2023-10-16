<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkarController;
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

Route::get('/', [AkarController::class, 'index'])->name('square_root.index');
Route::post('/calculate', [AkarController::class, 'calculate'])->name('square_root.calculate');
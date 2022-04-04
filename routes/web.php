<?php

use App\Http\Controllers\FoldersController;
use App\Http\Controllers\ImagesController;

use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FoldersController::class, 'index']);

Route::get('/voting/{folder_id}', [ImagesController::class,'index'])->name('folder');

Route::get('/up/{image_id}', [VotesController::class, 'up'])->name('up');

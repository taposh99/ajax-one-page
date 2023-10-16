<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserProfileController::class, 'index'])->name('index');
Route::post('/storeData', [UserProfileController::class, 'storeData'])->name('storeData');
Route::get('edit/{id}', [UserProfileController::class, 'edit'])->name('edit');

Route::post('update', [UserProfileController::class, 'update'])->name('update');

Route::delete('delete', [UserProfileController::class, 'destroy'])->name('delete');



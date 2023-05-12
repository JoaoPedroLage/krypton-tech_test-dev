<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;

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

Route::get('/', function () {
    return view('list_screen');
});

Route::get('/test', function () {
  return view('welcome');
});

Route::middleware('web')->post('/', 'CarController@delete');

Route::post('/', [CarController::class, 'delete'])->name('car.delete');

//

Route::post('/atividades', function () {
  return view('api');
});
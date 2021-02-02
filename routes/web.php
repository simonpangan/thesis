<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/User', function () {
        return view('user');
    })->name('user')->middleware('role:User');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('role:Admin')->name('home');

});


//for testing
//refactor
use App\Http\Controllers\BooksController;

Route::post('/books', [BooksController::class, 'store']);
Route::patch('/books/{book}', [BooksController::class, 'update']);
 Route::delete('/books/{book}', [BooksController::class, 'destroy']);
// Route::patch('/books/{book}-{slug}', [App\Http\Controllers\BooksController::class, 'update']);
// Route::delete('/books/{book}-{slug}', [App\Http\Controllers\BooksController::class, 'destroy']);


Route::post('/author', [App\Http\Controllers\AuthorsController::class, 'store']);
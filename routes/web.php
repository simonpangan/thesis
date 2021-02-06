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

//email verification 

Auth::routes(['verify' => true]);

// email testing
use App\Mail\WelcomeMail;
Route::get('/email', function () { 
    Mail::to('email@email.com')->send(new WelcomeMail());
    return new WelcomeMail();
});


Route::middleware(['auth','verified'])->group(function () {

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


//FOR LARAVEL RELATIONSHIP

Route::get('/onetoone', function () {

    $user = \App\Models\Accounts::find(1);
    $userPhone = $user->phone;//

    $phone = \App\Models\Phone::find(1);
    $phoneUser = $phone->user;


    return $phone;
});

Route::get('/onetomany', function () {

    $user = \App\Models\Accounts::find(2);
    $userpost = $user->posts;//

    $phone = \App\Models\Phone::find(1);
    $phoneUser = $phone->user;


    return $user;
});


Route::get('/manytomany', function () {

    $user = \App\Models\Accounts::find(1);
    $userSubjects = $user->subjects;
   
    // $subject = \App\Models\Subject::find(1);
    // $subjectusers = $subject->user;

    return $userSubjects[0]->subjectname;
});


Route::get('/loopUpOneToONe', function () {

    $user = \App\Models\Accounts::find(1);
    $userpost = $user->posts;//
    $userSex = $user->sex;//


    return $userSex->Sex;
});



Route::get('/loopUpOneToMany', function () {

    $user = \App\Models\Sex::find(1);
    $allsexs = \App\Models\Sex::all();
    return $user->users;
});



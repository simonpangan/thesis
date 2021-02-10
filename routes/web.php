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

// Route::get('/verify/resend', [App\Http\Controllers\TwoFactorController::class, 'resend'])->name('verify.resend');


// Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
// Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);



Route::get('/', function () {
    
    return view('welcome');
});

//EmailAddress verification 
Auth::routes(['verify' => true]);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;




Route::post('/forgot-password', function (Request $request) {

    $request->validate(['userEmail' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('userEmail')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['userEmail' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'userEmail' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('userEmail', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

         //   event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['userEmail' => [__($status)]]);
})->middleware('guest')->name('password.update');




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



// EmailAddress testing
// use App\Mail\WelcomeMail;
use App\Events\NewCustomerHasRegisteredEvent;
Route::get('/EmailAddress', function () { 

    // Mail::to('EmailAddress@EmailAddress.com')->send(new WelcomeMail());  /step1
    // dump('Registed to newsletter'); //step 2
    // dump('Stack message here'); // step 3


    $user = [
      'email' => "simon_pangan@yahoo.com",  
    ];
            
    event(new NewCustomerHasRegisteredEvent($user));
}); 


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



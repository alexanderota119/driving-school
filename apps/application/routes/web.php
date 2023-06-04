<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/login', [LoginController::class, 'login']);

use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Route::get('/avatar/user/{user}', function (User $user) {
//    return Avatar::create($user->name)->toSvg();
//});

Route::get('/avatar/user/{user}', function (User $user) {
    $response = Response::make(Avatar::create($student->name)->toSvg(), 200);
    $response->header('Content-Type', 'image/svg+xml');

    return $response;
})->name('user.avatar');

Route::get('/avatar/instructor/{instructor}', function (Instructor $instructor) {
    $response = Response::make(Avatar::create($instructor->name)->toSvg(), 200);
    $response->header('Content-Type', 'image/svg+xml');

    return $response;
})->name('instructor.avatar');

Route::get('/avatar/student/{student}', function (Student $student) {
    $response = Response::make(Avatar::create($student->name)->toSvg(), 200);
    $response->header('Content-Type', 'image/svg+xml');

    return $response;
})->name('student.avatar');

Route::get('/instructor/{instructor}/avatar', function (Instructor $instructor) {
    $response = Response::make(Avatar::create($instructor->name)->toSvg(), 200);
    $response->header('Content-Type', 'image/svg+xml');

    return $response;
});

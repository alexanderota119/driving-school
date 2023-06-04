<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ApiCalendarStudentAppointmentController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SpecialEventsController;
use App\Http\Controllers\StudentAppointmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPaymentController;
use App\Http\Controllers\StudentTypeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TestLocationController;
use App\Http\Controllers\TimeOffController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::get('/', action: [HomeController::class, 'index']);

// TODO :: temporary routes
Route::get('dashboard', action: [HomeController::class, 'index'])->name('dashboard');
Route::any('search/student', [HomeController::class, 'search']);

Route::get('profile', action: [ProfileController::class, 'profile']);
Route::get('my-profile', [ProfileController::class, 'profile']);
Route::put('profile', [ProfileController::class, 'save']);

Route::get('profile/timeoff', action: [ProfileController::class, 'timeoff']);
Route::put('profile/timeoff', [ProfileController::class, 'timeoff_save']);

Route::get('home', [HomeController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);
Route::get('my-requests', [TimeOffController::class, 'my_requests']);
Route::inertia('about', 'About/Tenant');

Route::get('tenant', [TenantController::class, 'editMine']);
Route::post('tenant', [TenantController::class, 'updateMine']);

/**
 * RESOURCE ROUTES
 */
Route::resources([
    'cars'              => CarController::class,
    'users'             => UserController::class,
    'courses'           => CourseController::class,
    'schools'           => SchoolController::class,
    'special_events'    => SpecialEventsController::class,
    'students'          => StudentController::class,
    'tenants'           => TenantController::class,
    'test_locations'    => TestLocationController::class,
    'time_off'          => TimeOffController::class,
    'student_types'     => StudentTypeController::class,
    'appointment_types' => AppointmentTypeController::class,

    'students.payments'     => StudentPaymentController::class,
    'students.appointments' => StudentAppointmentController::class,
]);

Route::resource('instructors', InstructorController::class)->except(['edit', 'update']);

Route::get('instructors/{any_instructor}/edit', [InstructorController::class, 'edit']);
Route::put('instructors/{any_instructor}', [InstructorController::class, 'update']);

Route::prefix('api')->group(function (Router $router) {
    $router->resource('students.appointments', ApiCalendarStudentAppointmentController::class);
});

<?php

use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;


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
    return view('auth.login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::resource('admin', AdminController::class);
Route::resource('home', HomeController::class);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/team', [PageController::class, 'Team'])->name('team');
    // Route::get('/staff', [PageController::class, 'Staff'])->name('staff');
    // Route::get('/supervisor', [PageController::class, 'Supervisor'])->name('supervisor');
    // Route::get('/kabag', [PageController::class, 'Kabag'])->name('kabag');
    Route::get('/staff-list', [PageController::class, 'List'])->name('list');
    Route::get('/emp-list', [PageController::class, 'List2'])->name('list2');
    Route::get('/history', [PageController::class, 'History'])->name('history');
    Route::get('/edit', [PageController::class, 'changePassword'])->name('password.edit');
    Route::patch('password', [PageController::class, 'Update'])->name('password.update');
    Route::get('/my-task', [PageController::class, 'MyTask'])->name('my.task');
    Route::get('/team-task', [PageController::class, 'TeamTask'])->name('team.task');
    Route::get('/detail/{user_id}', [PageController::class, 'DetailUser'])->name('detail.user');
    Route::get('/company-task', [PageController::class, 'CompanyTask'])->name('company.task');
    Route::get('/company-task/{bagian}', [PageController::class, 'DivisionTask'])->name('detail.bagian');
});

Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

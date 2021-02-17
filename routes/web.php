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



// Route::resource('posts', App\Http\Controllers\PostController::class);
Auth::routes();
Route::resource('admin', AdminController::class);
Route::resource('home', HomeController::class);
// Route::resource('detail', DetailController::class);
// Route::match(['resource', 'post'], 'detail', DetailController::class);

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/detail/{user_id}', [PageController::class, 'Detail'])->name('detail');
    Route::get('/team', [PageController::class, 'Team'])->name('team');
    Route::get('/staff', [PageController::class, 'Staff'])->name('staff');
    Route::get('/supervisor', [PageController::class, 'Supervisor'])->name('supervisor');
    Route::get('/kabag', [PageController::class, 'Kabag'])->name('kabag');
    Route::get('/staff-list', [PageController::class, 'List'])->name('list');
    Route::get('/emp-list', [PageController::class, 'List2'])->name('list2');
    Route::get('/history', [PageController::class, 'History'])->name('history');
    Route::get('/edit', [PageController::class, 'changePassword'])->name('password.edit');
    Route::patch('password', [PageController::class, 'Update'])->name('password.update');
    Route::get('/my-task', [PageController::class, 'MyTask'])->name('my.task');
    Route::get('/team-task', [PageController::class, 'TeamTask'])->name('team.task');
    Route::get('/detail/{user_id}', [PageController::class, 'DetailUser'])->name('detail.user');
    Route::get('/dttbl', [PageController::class, 'UserTask'])->name('user.task');
    Route::get('/company-task', [PageController::class, 'CompanyTask'])->name('company.task');
    // Route::get('/', [PageController::class, 'TeamTask'])->name('team.task');
});

Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
// Route::get('spv/home', [App\Http\Controllers\HomeController::class, 'spvHome'])->name('spv.home')->middleware('jabatan');
// Route::get('staff/home', [App\Http\Controllers\HomeController::class, 'staffHome'])->name('staff.home')->middleware('jabatan');
// Route::get('kabag/home', [App\Http\Controllers\HomeController::class, 'kabagHome'])->name('kabag.home')->middleware('jabatan');
// Route::get('vp/home', [App\Http\Controllers\HomeController::class, 'vpHome'])->name('vp.home')->middleware('jabatan');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home')->middleware('jabatan');
// Route::get('task/create', [App\Http\Controllers\PostController::class, 'create']);
// Route::get('/staff/team', [App\Http\Controllers\HomeController::class, 'indexTeam']);
// Route::get('/spv/staff', [App\Http\Controllers\HomeController::class, 'indexStaff']);
// Route::get('/spv/supervisor', [App\Http\Controllers\HomeController::class, 'indexSupervisor']);
// Route::get('/kabag/staff', [App\Http\Controllers\HomeController::class, 'indexStaff']);
// Route::get('/kabag/supervisor', [App\Http\Controllers\HomeController::class, 'indexSupervisor']);
// Route::get('/vp/kabag', [App\Http\Controllers\HomeController::class, 'indexKabag']);
// // Route::post('/store', [App\Http\Controllers\PostController::class, 'store']);
// Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('posts.store');
// Route::get('/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('posts.edit');
// Route::post('/delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('posts.delete');

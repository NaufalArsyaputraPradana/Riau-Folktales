<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    DashboardController,
    CeritaController,
    RegisterUserController,
    LoginController,
    ReadingController,
    QuisController,
    ListeningController,
};
use App\Http\Controllers\Web\{
    IndexWebController,
    ListWebController,
    DetailWebController,
    QuizWebController,
};
use Illuminate\Auth\Events\Logout;

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
Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'UsersTableSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});

Route::get('/register', [RegisterUserController::class, 'index'])->name('registeruser.index');
Route::post('/register', [RegisterUserController::class, 'store'])->name('registeruser.store');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('loginuser.index');
Route::post('/login', [LoginController::class, 'login'])->name('loginuser.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logoutuser.index');

// ADMIN
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('cerita', CeritaController::class);
    Route::resource('reading', ReadingController::class);

    Route::get('/quis', [QuisController::class, 'index'])->name('quis.index');
    Route::get('/quis/create', [QuisController::class, 'create'])->name('quis.create');
    Route::post('/quis/store', [QuisController::class, 'store'])->name('quis.store');
    Route::get('/quis/edit/{id}', [QuisController::class, 'edit'])->name('quis.edit');
    Route::put('/quis/update/{id}', [QuisController::class, 'update'])->name('quis.update');
    Route::delete('/quis/delete/{id}', [QuisController::class, 'destroy'])->name('quis.destroy');
    Route::get('/quis/view-soal/{id}', [QuisController::class, 'viewSoal'])->name('quis.viewSoal');

    Route::get('/listening', [ListeningController::class, 'index'])->name('listening.index');
    Route::get('/listening/create', [ListeningController::class, 'create'])->name('listening.create');
    Route::post('/listening/store', [ListeningController::class, 'store'])->name('listening.store');
    Route::get('/listening/edit/{id}', [ListeningController::class, 'edit'])->name('listening.edit');
    Route::put('/listening/update/{id}', [ListeningController::class, 'update'])->name('listening.update');
    Route::delete('/listening/delete/{id}', [ListeningController::class, 'destroy'])->name('listening.destroy');
    Route::get('/listening/view-soal/{id}', [ListeningController::class, 'viewSoal'])->name('listening.viewSoal');
});
// ADMIN


// WEB
Route::get('/', [IndexWebController::class, 'index'])->name('pageweb.index');
Route::group(['middleware' => ['role:user,admin']], function () {
    Route::get('/list', [ListWebController::class, 'index'])->name('pageweb.list');
    Route::get('/detail/{nama_cerita}', [DetailWebController::class, 'index'])->name('pageweb.detail');
    Route::get('/play-quiz', [QuizWebController::class, 'index'])->name('pageweb.quiz');
});

// WEB
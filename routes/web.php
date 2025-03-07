<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{DashboardController,
    CeritaController,
    RegisterUserController,
    LoginController,
    ReadingController,
    QuisController,
    ListeningController,
    web\ListeningWebController,
    web\ReadingWebController};
use App\Http\Controllers\Web\{
    IndexWebController,
    ListWebController,
    DetailWebController,
    QuizWebController,
    ScoreReadingController,
    ScoreListeningController,
    ScoreQuizController
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

    Route::get('/reading', [ReadingController::class, 'index'])->name('reading.index');
    Route::get('/reading/create', [ReadingController::class, 'create'])->name('reading.create');
    Route::post('/reading/store', [ReadingController::class, 'store'])->name('reading.store');
    Route::get('/reading/edit/{id}', [ReadingController::class, 'edit'])->name('reading.edit');
    Route::put('/reading/update/{id}', [ReadingController::class, 'update'])->name('reading.update');
    Route::delete('/reading/delete/{id}', [ReadingController::class, 'destroy'])->name('reading.destroy');
    Route::get('/reading/view-soal/{id}', [ReadingController::class, 'viewSoal'])->name('reading.viewSoal');
});
// ADMIN

// WEB
Route::get('/', [IndexWebController::class, 'index'])->name('pageweb.index');
Route::group(['middleware' => ['role:user,admin']], function () {
    Route::get('/list', [ListWebController::class, 'index'])->name('pageweb.list');
    Route::get('/detail/{nama_cerita}', [DetailWebController::class, 'index'])->name('pageweb.detail');
    Route::get('/play-quiz', [QuizWebController::class, 'index'])->name('pageweb.quiz');
    Route::get('/play-listening', [ListeningWebController::class, 'index'])->name('pageweb.listening');
    Route::get('/play-reading', [ReadingWebController::class, 'index'])->name('pageweb.reading');
    Route::get('/api/soal', [ReadingWebController::class, 'getSoal']);
});
// WEB


Route::group(['middleware' => ['role:user,admin']], function () {
    //SAVE SCORE READING
    Route::get('/score-reading', [ScoreReadingController::class, 'index'])->name('scorereading.index');
    Route::post('/score-reading/update', [ScoreReadingController::class, 'scoreUpdateOrCreate'])->name('scorereading.update');
    //SAVE SCORE READING

    //SAVE SCORE LISTENING
    Route::get('/score-listening', [ScoreListeningController::class, 'index'])->name('scorelistening.index');
    Route::post('/score-listening/update', [ScoreListeningController::class, 'scoreUpdateOrCreate'])->name('scorelistening.update');
    //SAVE SCORE LISTENING

    //SAVE SCORE QUIZ
    Route::get('/score-quiz', [ScoreQuizController::class, 'index'])->name('scorequiz.index');
    Route::post('/score-quiz/update', [ScoreQuizController::class, 'scoreUpdateOrCreate'])->name('scorequiz.update');
    //SAVE SCORE QUIZ
});

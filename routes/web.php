<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        ///// with id
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    });

    Route::prefix('drive')->group(function () {
        Route::get('/index', [DeiveController::class, 'index'])->name('drive.index');
        Route::get('/create', [DeiveController::class, 'create'])->name('drive.create');
        Route::post('/store', [DeiveController::class, 'store'])->name('drive.store');
        ///// with id
        Route::get('/show/{id}', [DeiveController::class, 'show'])->name('drive.show');
        Route::get('/edit/{id}', [DeiveController::class, 'edit'])->name('drive.edit');
        Route::get('/destroy/{id}', [DeiveController::class, 'destroy'])->name('drive.destroy');
        Route::post('/update/{id}', [DeiveController::class, 'update'])->name('drive.update');
        Route::get('/download/{id}', [DeiveController::class, 'download'])->name('drive.download');
        Route::get('/publicDrives', [DeiveController::class, 'publicDrives'])->name('drive.publicDrives');
        Route::get('/cahngeStatus/{id}', [DeiveController::class, 'cahngeStatus'])->name('drive.cahngeStatus');
    });
    Route::post("user/changImage/{id}", [RegisteredUserController::class, 'changImage'])->name('user.changImage');
});



require __DIR__ . '/auth.php';

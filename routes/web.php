<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
//generate password
Route::get('/generate-password', function () {
    return Hash::make('password');
});

Route::get('/dashboard', function () {
    //alihkan sesuai role
    if (Auth::user()->role == 'user') {
        return redirect()->route('home');
    } elseif (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('login');
    }
})->middleware(['auth'])->name('dashboard');
Route::get('/checkRole', function () {
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role == 'user') {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
})->name('checkRole');
Route::get('/profile', [Controller::class, 'profile'])->middleware(['auth'])->name('profile');
Route::get('/profile/edit', [Controller::class, 'profile'])->middleware(['auth'])->name('profile.edit');

Route::post('/profile/{id}', [Controller::class, 'updateProfile'])->middleware(['auth'])->name('updateProfile');

Route::get('/checkRole', function () {
    if(Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
})->name('checkRole');

// UMUM ========================================================================================================
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/search/{key}', [UserController::class, 'search'])->name('search');

Route::middleware('checkRole:user')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('history', [UserController::class, 'history'])->name('history');
        Route::get('rent/{id}', [UserController::class, 'rent'])->name('rent');
        Route::post('rent/{id}', [UserController::class, 'rentBook'])->name('rent');
    });
});

Route::middleware('checkRole:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //masukkan ke dalam group route prefix admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('rents', RentController::class);
    });
});

//route php artisan storage:link
Route::get('/link', function () {
    //delete folder public/storage
    \Illuminate\Support\Facades\File::deleteDirectory(public_path('storage'));
    Artisan::call('storage:link');
    return 'berhasil';
})->name('link');

//buat akun admin
Route::get('/create-admin', function () {
    $user = new \App\Models\User();
    $user->name = 'Admin';
    $user->email = 'admin@book_rent.com';
    $user->password = Hash::make('password');
    $user->role = 'admin';

    $user->save();
    return 'berhasil';
});

// register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

require __DIR__ . '/auth.php';

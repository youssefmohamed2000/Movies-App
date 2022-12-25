<?php


use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth', 'role:super_admin|admin']], function () {

    // HOME
    Route::get('home', [HomeController::class, 'index'])->name('home');
  
    // ROLES
    Route::resource('roles', RoleController::class)->except('show');

    // ADMINS
    Route::resource('admins', AdminController::class)->except('show');

    // USERS
    Route::resource('users', UserController::class)->except('show');

    // GENRES
    Route::resource('genres', GenreController::class)->only(['index', 'destroy']);

    // MOVIES
    Route::resource('movies', MovieController::class)->only(['index', 'show', 'destroy']);

    // ACTORS
    Route::resource('actors', ActorController::class)->only(['index', 'destroy']);

    // SETTINGS
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::resource('settings', SettingController::class)->only('store');

    Route::name('profile.')->group(function () {

        // PROFILE
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('profile/update', [ProfileController::class, 'update'])->name('update');

        // PASSWORD
        Route::get('password/edit', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('password/update', [PasswordController::class, 'update'])->name('password.update');
    });
});

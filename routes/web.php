<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth']], function () {

    Route::Patch('profile_update/{id}', 'App\Http\Controllers\UsersController@profile_update')->name('users.profile_update');
    Route::Patch('update_password/{id}', 'App\Http\Controllers\UsersController@update_password')->name('users.update_password');
    Route::get('/user/{id}', 'App\Http\Controllers\UsersController@profile')->name('users.profile');

    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
});

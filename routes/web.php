<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AtcController;
use App\Http\Controllers\OperationsController;

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

Route::middleware("auth")->group(function () {

    Route::get('/', [MainController::class, "index"])->name('home');

    Route::prefix('atc')->group(function () {
        Route::get('/', [AtcController::class, "atc"])->name('atc');
        Route::get('check', [AtcController::class, "atc_check"])->name('atc_check');
        Route::get('update', [AtcController::class, "atc_update"])->name('atc_update');
        Route::get('add/filial', [AtcController::class, "atc_add_filial"])->name('atc_add_filial');

        Route::post('check', [AtcController::class, "atc_check_post"])->name('atc_check_post');
        Route::post('update', [AtcController::class, "atc_update_post"])->name('atc_update_post');
        Route::post('add/filial', [AtcController::class, "atc_add_filial_post"])->name('atc_add_filial_post');
    });

    Route::prefix('check')->group(function () {
        Route::get('/', [OperationsController::class, "check"])->name('check');
        Route::get('clients/bank', [OperationsController::class, "check_clients_bank"])->name('atc_clients_bank');
        Route::get('clients/cberbank', [OperationsController::class, "check_clients_cberbank"])->name('atc_clients_cberbank');

        Route::post('clients/bank', [OperationsController::class, "check_clients_bank_post"])->name('atc_clients_bank_post');
        Route::post('clients/cberbank', [OperationsController::class, "check_clients_cberbank_post"])->name('atc_clients_cberbank_post');
    });

    Route::post('signout', [AuthController::class, "signout"])->name("signout");

});

Route::get('login', [AuthController::class, "login"])->name("login");
Route::post('signin', [AuthController::class, "signin"])->name("signin");


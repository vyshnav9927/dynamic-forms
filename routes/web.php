<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormDataController;


Route::get('/', [FormController::class, 'index'])->name('home');
Route::get('/forms/show/{form?}', [FormController::class, 'show'])->name('form.show');
 Route::post('/formdata/{form?}/store', [FormDataController::class, 'store'])->name('formdata.store');

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('login.validate');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/forms/create', [FormController::class, 'create'])->name('admin.form.create');
    Route::get('/forms/index', [FormController::class, 'index'])->name('admin.form.index');
    Route::get('/forms/{form?}/show', [FormController::class, 'show'])->name('admin.form.show');
    Route::get('/forms/{form?}/edit', [FormController::class, 'edit'])->name('admin.form.edit');
    Route::post('/forms/store',  [FormController::class, 'store'])->name('admin.form.store');
    Route::get('/forms/{form?}/delete', [FormController::class, 'destroy'])->name('admin.form.delete');

    Route::get('/formfields/{formField?}/delete', [FormController::class, 'formFieldsDestory'])->name('admin.formfields.delete');
    Route::get('/formdata/{form?}/index', [FormDataController::class, 'index'])->name('admin.formdata.index');

    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

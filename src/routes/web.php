<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/admin', function () {
    return view('admin.admin');
})->middleware(['auth'])->name('admin.admin');
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])
->name('admin.admin');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::delete('/admin{id}', [AdminController::class, 'destroy'])->name('admin.delete');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UktController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ukt', [UktController::class, 'form'])->name('ukt.form');
Route::post('/ukt/predict', [UktController::class, 'predict'])->name('ukt.predict');
Route::post('/ukt/batch', [UktController::class, 'batch'])->name('ukt.batch');

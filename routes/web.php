<?php

use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AdController:: class, 'index'])->name('welcome');
Route::get('/singleAd/{id}', [AdController:: class, 'singleAd'])->name('welcome.singleAd');
Route::post('/singleAd/{id}/send-message', [AdController:: class, 'sendMessage'])->name('welcome.sendMessage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'storeDeposit'])->name('home.storeDeposit');
Route::get('/home/new-ad', [App\Http\Controllers\HomeController::class, 'newAd'])->name('home.newAd');
Route::get('/home/show-message', [App\Http\Controllers\HomeController::class, 'showMessage'])->name('home.showMessage');
Route::get('/home/show-message/reply', [App\Http\Controllers\HomeController::class, 'replyMessage'])->name('home.replyMessage');
Route::post('/home/show-message/reply', [App\Http\Controllers\HomeController::class, 'storeReply'])->name('home.storeReply');
Route::post('/home/new-ad', [App\Http\Controllers\HomeController::class, 'storeAd'])->name('home.storeAd');
Route::get('/home/singleAd/{id}', [App\Http\Controllers\HomeController::class, 'singleAd'])->name('home.singleAd');
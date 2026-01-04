<?php

use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('login');
});

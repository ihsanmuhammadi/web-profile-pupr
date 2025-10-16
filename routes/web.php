<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuidanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

});
Route::resource('guidances', GuidanceController::class);

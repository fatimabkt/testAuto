<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StagiaireController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('stagiaire', StagiaireController::class);

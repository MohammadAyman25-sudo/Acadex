<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::get("logs", [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware("auth");
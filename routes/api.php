<?php

use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/announcement', [AdminAnnouncementController::class, 'show']);

Route::get('/admin/totals', [AdminController::class, 'getTotals']);
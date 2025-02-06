<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiskController;

Route::get('/', [RiskController::class, 'index'])->name('risks.index');
Route::get('/risks/{risk_code}', [RiskController::class, 'show'])->name('risks.show');

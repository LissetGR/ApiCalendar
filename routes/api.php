<?php

use App\Http\Controllers\Calendario;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('crearMeet', [Calendario::class, 'crearEvento']);
});

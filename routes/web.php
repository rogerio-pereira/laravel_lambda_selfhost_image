<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try{
        Log::info('welcome');

        return view('welcome');
    }
    catch(\Exception $e)
    {
        dd($e);
    }
});

Route::get('/healthcheck', function () {
    try{
        Log::info('healthcheck');

        return response()->json(['status' => 'ok']);
    }
    catch(\Exception $e)
    {
        dd($e);
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

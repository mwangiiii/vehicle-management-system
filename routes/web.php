<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\UploadCsvController;
use App\Http\Controllers\UploadModelCsvController;

Route::get('/', function () {
    return view('welcome');
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



Route::get('/manufacturer/vehicle/create',[ManufacturerController::class, 'create'])->name('car-form');
Route::post('/manufacturer/vehicle/store' ,[ManufacturerController::class, 'store'])->name('storing-car');


Route::get('/vehicle/details/{id}', [ManufacturerController::class, 'show_one_vehicle'])->name('car-details');
Route::get('/vehicle/details', [ManufacturerController::class, 'vehicles_show_all'])->name('car-details-id');

Route::get('/make-csv', [UploadCsvController::class, 'create'])->name('uploading-csv-get');
Route::post('/admin/upload/make/csv/create', [UploadCsvController::class, 'store'])->name('uploading-csv-post');


Route::get('/model-csv',[UploadModelCsvController::class , 'create'])->name('uploading-csv-models-create');
Route::post('/admin/upload/models/csv/post',[UploadModelCsvController::class , 'store'])->name('uploading-csv-models-post');


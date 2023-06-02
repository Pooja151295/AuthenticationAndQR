<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\QrCodeController; 
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
 
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('/qrcode', [QrCodeController::class, 'index']);
//Route::post('/update', [QrCodeController::class, 'index']);
Route::post('update', [QrCodeController::class, 'index'])->name('update.post');
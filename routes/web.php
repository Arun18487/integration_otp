<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontrol;
use App\Http\Controllers\OTPcontroller;



Route::post('/userstore', [usercontrol::class, 'userstore'])->name('register');
Route::get('/signup', [usercontrol::class, 'signup'])->name('signup');
Route::get('/login', [usercontrol::class, 'login'])->name('login');
Route::post('/userlogin', [usercontrol::class, 'userlogin'])->name('userlogin');
Route::get('/user', [usercontrol::class, 'user'])->name('user');
Route::get('/userlogout', [usercontrol::class, 'userlogout'])->name('userlogout');
Route::get('/dashboard', [usercontrol::class, 'dashboard'])->name('dashboard');
Route::get('/verify-otp', [OTPcontroller::class, 'verifyOtpView'])->name('verify.otpview');
Route::post('/verify-otp', [OTPcontroller::class, 'verifyOtp'])->name('verify.otp');
Route::post('/send-otp', [OTPcontroller::class, 'sendOtp'])->name('send.otp');
Route::post('/resend-otp', [OTPcontroller::class, 'resendOtp'])->name('resend.otp');    

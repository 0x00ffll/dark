<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

// Guest routes (unauthenticated users only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// Authenticated routes
Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Simple placeholder route
    Route::get('/placeholder', function () {
        return view('placeholder');
    })->name('placeholder');
    
    // Profile and Settings routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/settings/clear-cache', [SettingsController::class, 'clearCache'])->name('settings.clear-cache');
    
    // IPTV Management Routes (placeholder views)
    Route::get('/channels', function () {
        return view('placeholder', ['title' => 'Channels Management', 'section' => 'channels']);
    })->name('channels.index');
    
    Route::get('/streams', function () {
        return view('placeholder', ['title' => 'Streams Management', 'section' => 'streams']);
    })->name('streams.index');
    
    Route::get('/bouquets', function () {
        return view('placeholder', ['title' => 'Bouquets Management', 'section' => 'bouquets']);
    })->name('bouquets.index');
    
    // Users & Access Routes (placeholder views)
    Route::get('/users', function () {
        return view('placeholder', ['title' => 'Users Management', 'section' => 'users']);
    })->name('users.index');
    
    Route::get('/devices', function () {
        return view('placeholder', ['title' => 'Devices Management', 'section' => 'devices']);
    })->name('devices.index');
    
    Route::get('/blocked-ips', function () {
        return view('placeholder', ['title' => 'Blocked IPs Management', 'section' => 'blocked-ips']);
    })->name('blocked-ips.index');
    
    // System Routes (placeholder views)
    Route::get('/logs', function () {
        return view('placeholder', ['title' => 'System Logs', 'section' => 'logs']);
    })->name('logs.index');
    
    Route::get('/cronjobs', function () {
        return view('placeholder', ['title' => 'Cron Jobs Management', 'section' => 'cronjobs']);
    })->name('cronjobs.index');
});

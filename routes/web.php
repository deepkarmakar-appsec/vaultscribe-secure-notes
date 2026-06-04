<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AiController;
use App\Http\Controllers\AdminController;
use App\Models\ActivityLog;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('login'))->name('home');

Route::get('login', [AuthController::class, 'log'])->name('login');
Route::post('login', [AuthController::class, 'logstore'])->middleware('throttle:5,1');

Route::get('/logout', function () {
    return redirect()->route('login');
});

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

// OTP Routes
Route::get('/otp', [OtpController::class, 'otp'])->name('otp.verify');
Route::post('/otp', [OtpController::class, 'verifyOtp'])->name('otp.verify.post');

// 2FA Challenge Context
Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

Route::get('forget', [PasswordController::class, 'forget'])->name('forget');
Route::post('forgetpass', [PasswordController::class, 'forgetpass'])->name('password.forget.post');
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED REQUIRED ROUTES (2FA Setup Phase)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
});

/*
|--------------------------------------------------------------------------
| FULLY PROTECTED VAULT ROUTES (Auth + 2FA Verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', '2fa'])->group(function () {

    Route::post('/notes/import-url', [NoteController::class, 'importUrl'])->name('notes.importUrl');

    Route::get('/dashboard', [NoteController::class, 'dashboard'])->name('dashboard');

    // Notes Core CRUD
    Route::post('/notes', [NoteController::class, 'dashboardValue'])->name('notes.store');
    Route::get('/notes/{note}/edit', [NoteController::class, 'notesedit'])->name('notes.edit');
    Route::put('/notes/{note}', [NoteController::class, 'notesupdate'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'notesdelete'])->name('notes.delete');

    // Trash System
    Route::get('/notes/trash', [NoteController::class, 'showtrash'])->name('notes.trash');
    Route::patch('/notes/trash/restore-all', [NoteController::class, 'restoreAll'])->name('notes.restoreAll');
    Route::delete('/notes/trash/delete-all', [NoteController::class, 'forcedeleteall'])->name('notes.deleteAll');
    Route::patch('/notes/{id}/restore', [NoteController::class, 'restore'])->name('notes.restore');
    Route::delete('/notes/{id}/force-delete', [NoteController::class, 'forcedelete'])->name('notes.forceDelete');
    
    // Disable 2FA Security Context
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

    // Secure File Upload System Actions
    Route::get('/upload', [FileUploadController::class, 'upload'])->name('upload');
    Route::post('/fileupload', [FileUploadController::class, 'fileupload'])
         ->name('fileupload')
         ->middleware('throttle:10,1');

    // Securely fetch private profile photos from storage/app/private/uploads/
    Route::get('/user/avatar/{filename}', function ($filename) {

        $path = storage_path('app/private/uploads/' . $filename);
    
        abort_unless(file_exists($path), 404);
    
        return response()->file($path, [
            'Content-Type' => 'image/webp',
        ]);
    
    })->name('profile.photo');
});

Route::post('/ai-summary', [AiController::class, 'generate'])
    ->middleware('auth');


    Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/admindashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/logs', [AdminController::class, 'logs'])
            ->name('admin.logs');

        // Baaki admin routes yahan aayenge
        Route::get('/users', [AdminController::class, 'users'])
            ->name('admin.users');

        Route::get('/users/{user}', [AdminController::class, 'showUser'])
            ->name('admin.users.show');

        Route::get('/notes', [AdminController::class, 'notes'])
            ->name('admin.notes');

        Route::get('/settings', [AdminController::class, 'settings'])
            ->name('admin.settings');
    });

/*
|--------------------------------------------------------------------------
| SECURE DE-AUTHENTICATION LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('logout', function (Request $req) {
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'logout',
        'ip_address' => $req->ip(),
        'user_agent' => $req->userAgent(),
    ]);

    Auth::logout();

    session()->forget(['2fa_passed', 'login_attempts', '2fa_user_id']);
    $req->session()->invalidate();
    $req->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');
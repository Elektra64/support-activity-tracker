<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityUpdateController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivityUpdatesExport;
use App\Exports\ReportExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTaskController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Profile Routes (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for Admin only (reports)
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/reports', [ActivityUpdateController::class, 'report'])->name('reports.index');
        Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
        
        Route::get('/admin/users/tasks', [AdminTaskController::class, 'index'])->name('admin.users.tasks');
      
    });

    // Routes for regular users (only their own updates)
    Route::get('/activities/assigned', [ActivityController::class, 'assigned'])
        ->name('activities.assigned');
    
    Route::resource('activities', ActivityController::class);
    Route::resource('updates', ActivityUpdateController::class);
    Route::get('/activity-updates/export', [ActivityUpdateController::class, 'export'])->name('activity-updates.export');
    
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{id}/promote', [AdminController::class, 'promote'])->name('admin.users.promote');
    Route::post('/admin/users/{id}/demote', [AdminController::class, 'demote'])->name('admin.users.demote');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.delete');
    Route::post('/admin/users/{user}/assign-activity', [AdminController::class, 'assignActivity'])->name('admin.users.assignActivity');

});

require __DIR__.'/auth.php';

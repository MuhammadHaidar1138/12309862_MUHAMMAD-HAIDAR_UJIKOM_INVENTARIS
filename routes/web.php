<?php

use App\Exports\AdminAccountExport;
use App\Exports\OperatorAccountExport;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\OperatorAccountController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('landing-page');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    Route::get('admin/items/export', [ItemController::class, 'export'])->name('item.export');

    Route::get('admin/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('admin/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('admin/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('admin/items/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('admin/items', [ItemController::class, 'store'])->name('item.store');
    Route::get('admin/items/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('admin/items/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('admin/items/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

    Route::get('admin/admin-accounts', [AdminAccountController::class, 'index'])->name('admin-account.index');
    Route::get('admin/admin-accounts/create', [AdminAccountController::class, 'create'])->name('admin-account.create');
    Route::post('admin/admin-accounts', [AdminAccountController::class, 'store'])->name('admin-account.store');
    Route::get('admin-accounts/{id}/edit', [AdminAccountController::class, 'edit'])->name('admin-account.edit');
    Route::put('admin/admin-accounts/{id}', [AdminAccountController::class, 'update'])->name('admin-account.update');
    Route::delete('admin/admin-accounts/{id}', [AdminAccountController::class, 'destroy'])->name('admin-account.destroy');
    Route::get('/admin-account/export', function () {
        return Excel::download(new AdminAccountExport, 'admin.xlsx');
    })->name('admin-account.export');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('pages.staff.dashboard');
    })->name('staff.dashboard');
    Route::get('/staff/lendings/create', [LendingController::class, 'create'])
        ->name('lending.create');
    Route::post('/staff/lendings', [LendingController::class, 'store'])
        ->name('lending.store');
});

Route::get('/lending', [LendingController::class, 'index'])->name('lending.index');
Route::patch('/lending/{id}/return', [LendingController::class, 'returnItem'])->name('lending.return');
Route::delete('/lending/{id}', [LendingController::class, 'destroy'])->name('lending.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/operator-accounts', [OperatorAccountController::class, 'index'])
        ->name('operator-account.index');
    Route::get('operator-accounts/create', [OperatorAccountController::class, 'create'])->name('operator-account.create');
    Route::post('operator-accounts', [OperatorAccountController::class, 'store'])->name('operator-account.store');
    Route::get('operator-accounts/{id}/edit', [OperatorAccountController::class, 'edit'])
        ->name('operator-account.edit');
    Route::put('operator-accounts/{id}', [OperatorAccountController::class, 'update'])
        ->name('operator-account.update');
    Route::delete('operator-accounts/{id}', [OperatorAccountController::class, 'destroy'])
        ->name('operator-account.destroy');
    Route::get('/operator-account/export', function () {
        return Excel::download(new OperatorAccountExport, 'operator.xlsx');
    })->name('operator-account.export');
});

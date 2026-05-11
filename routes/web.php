<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EggsController;
use App\Http\Controllers\FeedsController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DuckController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::resource('eggs', EggsController::class)->except(['show']);
Route::resource('feeds', FeedsController::class)->except(['show']);
Route::resource('ducks', DuckController::class)->except(['show']);
Route::resource('sales', SalesController::class)->except(['show']);
Route::resource('customers', CustomerController::class)->except(['show']);
Route::resource('suppliers', SupplierController::class)->except(['show']);
Route::resource('expenses', ExpenseController::class)->except(['show']);
Route::resource('inventory-logs', InventoryLogController::class)->only(['index']);
Route::resource('users', UserController::class)->only(['index']);
Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role.update');

Route::get('/reports/sales', [ReportController::class, 'salesIndex'])->name('reports.sales');
Route::get('/reports/sales/pdf', [ReportController::class, 'salesPdf'])->name('reports.sales.pdf');
Route::get('/reports/sales/excel', [ReportController::class, 'salesExcel'])->name('reports.sales.excel');
Route::get('/reports/daily/eggs', [ReportController::class, 'dailyEggsIndex'])->name('reports.daily.eggs');
Route::get('/reports/daily/eggs/pdf', [ReportController::class, 'dailyEggsPdf'])->name('reports.daily.eggs.pdf');
Route::get('/reports/daily/eggs/excel', [ReportController::class, 'dailyEggsExcel'])->name('reports.daily.eggs.excel');
Route::get('/reports/daily/feeds', [ReportController::class, 'dailyFeedsIndex'])->name('reports.daily.feeds');
Route::get('/reports/daily/feeds/pdf', [ReportController::class, 'dailyFeedsPdf'])->name('reports.daily.feeds.pdf');
Route::get('/reports/daily/feeds/excel', [ReportController::class, 'dailyFeedsExcel'])->name('reports.daily.feeds.excel');
Route::get('/reports/inventory/pdf', [ReportController::class, 'inventoryPdf'])->name('reports.inventory.pdf');
Route::get('/reports/inventory/excel', [ReportController::class, 'inventoryExcel'])->name('reports.inventory.excel');

Route::redirect('/Feeds', '/feeds');
Route::redirect('/Sales', '/sales');

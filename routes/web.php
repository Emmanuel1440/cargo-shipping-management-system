<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

// Main Resources
Route::resource('ships', ShipController::class);
Route::resource('crews', CrewController::class);
Route::resource('ports', PortController::class);
Route::resource('clients', ClientController::class);
Route::resource('cargos', CargoController::class);
Route::resource('shipments', ShipmentController::class);

// Toggle status
Route::patch('/clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])->name('clients.toggle-status');
Route::patch('/ports/{port}/toggle-status', [PortController::class, 'toggleStatus'])->name('ports.toggleStatus');

// Reports
Route::get('/reports/shipments', [ReportController::class, 'shipments'])->name('reports.shipments');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/notifications', [DashboardController::class, 'notifications'])->name('dashboard.notifications');

// Notification History View
Route::get('/notifications', function () {
    return view('dashboard.notifications');
})->middleware('auth');

// (Optional) Test notification trigger
Route::get('/test-notification', function () {
    $user = \App\Models\User::first();
    $shipment = \App\Models\Shipment::latest()->first();

    if ($user && $shipment) {
        $user->notify(new \App\Notifications\ShipmentArrivalNotification($shipment));
        return 'Notification sent!';
    }

    return 'Missing user or shipment';
});

// Home route
Route::get('/', function () {
    return view('welcome');
});

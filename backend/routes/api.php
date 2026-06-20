<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FcmController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/brands', [VehicleController::class, 'brands']);
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/vehicles/{id}', [VehicleController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth profile & logout
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::put('/auth/me', [AuthController::class, 'updateProfile']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Vehicles write ops
    Route::post('/vehicles', [VehicleController::class, 'store']);
    Route::put('/vehicles/{id}', [VehicleController::class, 'update']);
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy']);

    // Requests
    Route::post('/purchase-requests', [RequestController::class, 'submitPurchase']);
    Route::get('/purchase-requests', [RequestController::class, 'listPurchase']);
    Route::put('/purchase-requests/{id}/status', [RequestController::class, 'updatePurchaseStatus']);

    Route::post('/rental-requests', [RequestController::class, 'submitRental']);
    Route::get('/rental-requests', [RequestController::class, 'listRental']);
    Route::put('/rental-requests/{id}/status', [RequestController::class, 'updateRentalStatus']);

    // Wishlist
    Route::get('/wishlists', [WishlistController::class, 'index']);
    Route::post('/wishlists/toggle', [WishlistController::class, 'toggle']);
    Route::get('/wishlists/check/{vehicleId}', [WishlistController::class, 'check']);

    // FCM Push Notification
    Route::post('/fcm/register', [FcmController::class, 'register']);
    Route::post('/fcm/unregister', [FcmController::class, 'unregister']);

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::put('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Admin Panel
    Route::get('/admin/pending-vehicles', [AdminController::class, 'listPendingVehicles']);
    Route::put('/admin/verify-vehicle/{id}', [AdminController::class, 'verifyVehicle']);
    Route::get('/admin/users', [AdminController::class, 'listUsers']);
    Route::put('/admin/users/{id}/toggle-active', [AdminController::class, 'toggleUserActive']);
});

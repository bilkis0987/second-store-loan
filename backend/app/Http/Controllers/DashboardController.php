<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\RentalRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = match ($user->role) {
            'admin' => $this->adminDashboard(),
            'seller' => $this->sellerDashboard($user->id),
            'rental' => $this->rentalDashboard($user->id),
            default => $this->userDashboard($user->id),
        };

        return $this->successResponse($data, 'Data dashboard berhasil diambil');
    }

    private function adminDashboard(): array
    {
        return [
            'total_users' => User::count(),
            'total_vehicles' => Vehicle::count(),
            'pending_vehicles' => Vehicle::where('status', 'pending')->count(),
            'active_vehicles' => Vehicle::where('status', 'available')->count(),
            'total_transactions' => Transaction::count(),
            'total_purchase_requests' => PurchaseRequest::count(),
            'total_rental_requests' => RentalRequest::count(),
        ];
    }

    private function sellerDashboard(int $userId): array
    {
        return [
            'total_vehicles' => Vehicle::where('owner_id', $userId)->count(),
            'active_vehicles' => Vehicle::where('owner_id', $userId)->where('status', 'available')->count(),
            'pending_vehicles' => Vehicle::where('owner_id', $userId)->where('status', 'pending')->count(),
            'sold_vehicles' => Vehicle::where('owner_id', $userId)->where('status', 'sold')->count(),
            'purchase_requests' => PurchaseRequest::whereHas('vehicle', function ($q) use ($userId) {
                $q->where('owner_id', $userId);
            })->count(),
            'transactions' => Transaction::where('seller_id', $userId)->count(),
        ];
    }

    private function rentalDashboard(int $userId): array
    {
        return [
            'total_vehicles' => Vehicle::where('owner_id', $userId)->count(),
            'available_vehicles' => Vehicle::where('owner_id', $userId)->where('status', 'available')->count(),
            'rented_vehicles' => Vehicle::where('owner_id', $userId)->where('status', 'rented')->count(),
            'rental_requests' => RentalRequest::whereHas('vehicle', function ($q) use ($userId) {
                $q->where('owner_id', $userId);
            })->count(),
            'active_rentals' => RentalRequest::whereHas('vehicle', function ($q) use ($userId) {
                $q->where('owner_id', $userId);
            })->where('status', 'active')->count(),
        ];
    }

    private function userDashboard(int $userId): array
    {
        return [
            'purchase_requests' => PurchaseRequest::where('user_id', $userId)->count(),
            'rental_requests' => RentalRequest::where('user_id', $userId)->count(),
            'wishlist_count' => \App\Models\Wishlist::where('user_id', $userId)->count(),
            'transactions' => Transaction::where('buyer_id', $userId)->count(),
        ];
    }
}

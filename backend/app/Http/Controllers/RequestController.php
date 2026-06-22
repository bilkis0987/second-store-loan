<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\RentalRequest;
use App\Models\Vehicle;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function submitPurchase(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'offer_price' => 'required|numeric|min:0',
            'message' => 'nullable|string',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if ($vehicle->owner_id === $request->user()->id) {
            return $this->errorResponse('Anda tidak dapat membeli kendaraan Anda sendiri.', 422);
        }

        if ($vehicle->transaction_type !== 'jual') {
            return $this->errorResponse('Kendaraan ini tidak dijual.', 422);
        }

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'pending';

        $purchaseRequest = PurchaseRequest::create($validated);

        $purchaseRequest->load(['vehicle:id,title,owner_id', 'user:id,name']);

        return $this->successResponse($purchaseRequest, 'Pengajuan pembelian berhasil dikirim', 201);
    }

    public function listPurchase(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = PurchaseRequest::with([
            'vehicle:id,title,thumbnail,price,owner_id',
            'vehicle.owner:id,name',
            'user:id,name,photo',
        ]);

        if ($user->role === 'admin') {
            // admin sees all
        } elseif (in_array($user->role, ['seller', 'rental'])) {
            $query->whereHas('vehicle', function ($q) use ($user) {
                $q->where('owner_id', $user->id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        $query->orderBy('created_at', 'desc');
        $perPage = $request->per_page ?? 15;
        $requests = $query->paginate($perPage);

        return $this->successResponse(
            $requests->items(),
            'Daftar pengajuan pembelian berhasil diambil',
            200,
            $this->paginationMeta($requests)
        );
    }

    public function updatePurchaseStatus(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,cancelled',
        ]);

        $purchaseRequest = PurchaseRequest::with('vehicle')->findOrFail($id);
        $user = $request->user();

        $isOwner = $purchaseRequest->vehicle->owner_id === $user->id;
        $isAdmin = $user->role === 'admin';
        $isBuyer = $purchaseRequest->user_id === $user->id && $validated['status'] === 'cancelled';

        if (!$isOwner && !$isAdmin && !$isBuyer) {
            return $this->errorResponse('Anda tidak memiliki akses.', 403);
        }

        $purchaseRequest->update(['status' => $validated['status']]);

        if ($validated['status'] === 'approved') {
            $purchaseRequest->vehicle->update(['status' => 'sold']);
        }

        $this->notificationService->purchaseStatusUpdated($purchaseRequest);

        return $this->successResponse($purchaseRequest->fresh()->load('vehicle'), 'Status pengajuan berhasil diperbarui');
    }

    public function submitRental(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'rental_start_date' => 'required|date|after_or_equal:today',
            'rental_end_date' => 'required|date|after:rental_start_date',
            'note' => 'nullable|string',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if ($vehicle->owner_id === $request->user()->id) {
            return $this->errorResponse('Anda tidak dapat menyewa kendaraan Anda sendiri.', 422);
        }

        if ($vehicle->transaction_type !== 'sewa') {
            return $this->errorResponse('Kendaraan ini tidak disewakan.', 422);
        }

        $start = \Carbon\Carbon::parse($validated['rental_start_date']);
        $end = \Carbon\Carbon::parse($validated['rental_end_date']);
        $totalDays = $start->diffInDays($end) + 1;

        $pricePerDay = $vehicle->rental_price_daily ?? $vehicle->rental_price_weekly / 7 ?? $vehicle->rental_price_monthly / 30 ?? 0;
        $totalPrice = $pricePerDay * $totalDays;

        $validated['user_id'] = $request->user()->id;
        $validated['total_days'] = $totalDays;
        $validated['total_price'] = $totalPrice;
        $validated['status'] = 'pending';

        $rentalRequest = RentalRequest::create($validated);
        $rentalRequest->load(['vehicle:id,title', 'user:id,name']);

        return $this->successResponse($rentalRequest, 'Pengajuan sewa berhasil dikirim', 201);
    }

    public function listRental(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = RentalRequest::with([
            'vehicle:id,title,thumbnail,owner_id',
            'vehicle.owner:id,name',
            'user:id,name,photo',
        ]);

        if ($user->role === 'admin') {
            // admin sees all
        } elseif (in_array($user->role, ['seller', 'rental'])) {
            $query->whereHas('vehicle', function ($q) use ($user) {
                $q->where('owner_id', $user->id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        $query->orderBy('created_at', 'desc');
        $perPage = $request->per_page ?? 15;
        $requests = $query->paginate($perPage);

        return $this->successResponse(
            $requests->items(),
            'Daftar pengajuan sewa berhasil diambil',
            200,
            $this->paginationMeta($requests)
        );
    }

    public function updateRentalStatus(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,active,completed,cancelled',
        ]);

        $rentalRequest = RentalRequest::with('vehicle')->findOrFail($id);
        $user = $request->user();

        $isOwner = $rentalRequest->vehicle->owner_id === $user->id;
        $isAdmin = $user->role === 'admin';
        $isRenter = $rentalRequest->user_id === $user->id && $validated['status'] === 'cancelled';

        if (!$isOwner && !$isAdmin && !$isRenter) {
            return $this->errorResponse('Anda tidak memiliki akses.', 403);
        }

        $rentalRequest->update(['status' => $validated['status']]);

        if (in_array($validated['status'], ['approved', 'active'])) {
            $rentalRequest->vehicle->update(['status' => 'rented']);
        } elseif (in_array($validated['status'], ['completed', 'cancelled', 'rejected'])) {
            $rentalRequest->vehicle->update(['status' => 'available']);
        }

        $this->notificationService->rentalStatusUpdated($rentalRequest);

        return $this->successResponse($rentalRequest->fresh()->load('vehicle'), 'Status pengajuan berhasil diperbarui');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AdminVerification;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function listPendingVehicles(Request $request): JsonResponse
    {
        $vehicles = Vehicle::with(['owner:id,name,phone', 'brand:id,name'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate($request->per_page ?? 15);

        return $this->successResponse(
            $vehicles->items(),
            'Daftar kendaraan menunggu verifikasi berhasil diambil',
            200,
            $this->paginationMeta($vehicles)
        );
    }

    public function verifyVehicle(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string',
        ]);

        $vehicle = Vehicle::findOrFail($id);

        if ($vehicle->status !== 'pending') {
            return $this->errorResponse('Kendaraan sudah diverifikasi.', 422);
        }

        $newStatus = $validated['status'] === 'approved' ? 'available' : 'rejected';
        $vehicle->update(['status' => $newStatus]);

        AdminVerification::create([
            'vehicle_id' => $vehicle->id,
            'admin_id' => $request->user()->id,
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
            'verified_at' => now(),
        ]);

        $this->notificationService->vehicleVerified($vehicle);

        return $this->successResponse($vehicle->fresh(), 'Verifikasi kendaraan berhasil');
    }

    public function listUsers(Request $request): JsonResponse
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')
            ->paginate($request->per_page ?? 15);

        return $this->successResponse(
            $users->items(),
            'Daftar pengguna berhasil diambil',
            200,
            $this->paginationMeta($users)
        );
    }

    public function toggleUserActive($id): JsonResponse
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return $this->errorResponse('Tidak dapat menonaktifkan admin.', 422);
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return $this->successResponse($user, "Pengguna berhasil {$status}");
    }
}

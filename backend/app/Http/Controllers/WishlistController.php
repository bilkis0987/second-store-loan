<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $wishlists = Wishlist::with(['vehicle' => function ($q) {
            $q->with(['brand:id,name', 'owner:id,name,photo']);
        }])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($wishlists, 'Daftar wishlist berhasil diambil');
    }

    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $userId = $request->user()->id;
        $vehicleId = $validated['vehicle_id'];

        $existing = Wishlist::where('user_id', $userId)
            ->where('vehicle_id', $vehicleId)
            ->first();

        if ($existing) {
            $existing->delete();
            return $this->successResponse(['wishlisted' => false], 'Berhasil dihapus dari wishlist');
        }

        Wishlist::create([
            'user_id' => $userId,
            'vehicle_id' => $vehicleId,
        ]);

        return $this->successResponse(['wishlisted' => true], 'Berhasil ditambahkan ke wishlist', 201);
    }

    public function check(Request $request, $vehicleId): JsonResponse
    {
        $exists = Wishlist::where('user_id', $request->user()->id)
            ->where('vehicle_id', $vehicleId)
            ->exists();

        return $this->successResponse(['wishlisted' => $exists]);
    }
}

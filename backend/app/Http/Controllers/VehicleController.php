<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function brands(): JsonResponse
    {
        $brands = VehicleBrand::orderBy('name')->get();

        return $this->successResponse($brands, 'Daftar brand berhasil diambil');
    }

    public function index(Request $request): JsonResponse
    {
        $query = Vehicle::with(['owner:id,name,photo', 'brand:id,name'])
            ->whereIn('status', ['available', 'rented']);

        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortField = $request->sort ?? 'created_at';
        $sortOrder = $request->order ?? 'desc';
        $query->orderBy($sortField, $sortOrder);

        $perPage = $request->per_page ?? 15;
        $vehicles = $query->paginate($perPage);

        return $this->successResponse(
            $vehicles->items(),
            'Daftar kendaraan berhasil diambil',
            200,
            $this->paginationMeta($vehicles)
        );
    }

    public function show($id): JsonResponse
    {
        $vehicle = Vehicle::with([
            'owner:id,name,phone,photo',
            'brand:id,name',
            'images',
        ])->findOrFail($id);

        return $this->successResponse($vehicle, 'Detail kendaraan berhasil diambil');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand_id' => 'required|exists:vehicle_brands,id',
            'category' => 'required|string|max:100',
            'transaction_type' => 'required|in:jual,sewa',
            'price' => 'nullable|numeric|min:0',
            'rental_price_daily' => 'nullable|numeric|min:0',
            'rental_price_weekly' => 'nullable|numeric|min:0',
            'rental_price_monthly' => 'nullable|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'transmission' => 'required|in:manual,matic',
            'fuel_type' => 'required|in:bensin,diesel,listrik,hybrid',
            'mileage' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $validated['owner_id'] = $request->user()->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        $validated['status'] = 'pending';
        $validated['thumbnail'] = $request->file('thumbnail')->store('vehicles', 'public');

        $vehicle = Vehicle::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('vehicles', 'public');
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_url' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        $vehicle->load(['brand:id,name', 'images']);

        return $this->successResponse($vehicle, 'Kendaraan berhasil ditambahkan', 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($vehicle->owner_id !== $request->user()->id) {
            return $this->errorResponse('Anda tidak memiliki akses ke kendaraan ini.', 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'brand_id' => 'sometimes|exists:vehicle_brands,id',
            'category' => 'sometimes|string|max:100',
            'transaction_type' => 'sometimes|in:jual,sewa',
            'price' => 'nullable|numeric|min:0',
            'rental_price_daily' => 'nullable|numeric|min:0',
            'rental_price_weekly' => 'nullable|numeric|min:0',
            'rental_price_monthly' => 'nullable|numeric|min:0',
            'year' => 'sometimes|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'sometimes|string|max:50',
            'transmission' => 'sometimes|in:manual,matic',
            'fuel_type' => 'sometimes|in:bensin,diesel,listrik,hybrid',
            'mileage' => 'sometimes|integer|min:0',
            'location' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('vehicles', 'public');
        }

        if ($request->has('title') && $request->title !== $vehicle->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        }

        $vehicle->update($validated);

        if ($request->hasFile('images')) {
            $vehicle->images()->delete();
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('vehicles', 'public');
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_url' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        $vehicle->load(['brand:id,name', 'images']);

        return $this->successResponse($vehicle, 'Kendaraan berhasil diperbarui');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($vehicle->owner_id !== $request->user()->id && $request->user()->role !== 'admin') {
            return $this->errorResponse('Anda tidak memiliki akses ke kendaraan ini.', 403);
        }

        $vehicle->delete();

        return $this->successResponse(null, 'Kendaraan berhasil dihapus');
    }
}

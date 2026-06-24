<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Vehicle;

class NotificationService
{
    public function create($userId, string $type, string $title, string $message, $data = null): Notification
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data ? json_encode($data) : null,
        ]);
    }

    public function vehicleVerified(Vehicle $vehicle): void
    {
        $status = $vehicle->status === 'available' ? 'disetujui' : 'ditolak';
        $this->create(
            $vehicle->owner_id,
            'vehicle_verified',
            'Kendaraan Terverifikasi',
            "Kendaraan {$vehicle->title} telah {$status} oleh admin.",
            ['vehicle_id' => $vehicle->id, 'status' => $vehicle->status]
        );
    }

    public function purchaseStatusUpdated($purchaseRequest): void
    {
        $statusMap = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'cancelled' => 'dibatalkan',
        ];
        $statusLabel = $statusMap[$purchaseRequest->status] ?? $purchaseRequest->status;

        $this->create(
            $purchaseRequest->user_id,
            'purchase_status_updated',
            'Status Pembelian Diperbarui',
            "Pengajuan pembelian {$purchaseRequest->vehicle->title} telah {$statusLabel}.",
            ['purchase_request_id' => $purchaseRequest->id, 'status' => $purchaseRequest->status]
        );

        $this->create(
            $purchaseRequest->vehicle->owner_id,
            'purchase_status_updated',
            'Status Pembelian Diperbarui',
            "Pengajuan pembelian {$purchaseRequest->vehicle->title} telah {$statusLabel}.",
            ['purchase_request_id' => $purchaseRequest->id, 'status' => $purchaseRequest->status]
        );
    }

    public function rentalStatusUpdated($rentalRequest): void
    {
        $statusMap = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'active' => 'aktif',
            'completed' => 'selesai',
            'cancelled' => 'dibatalkan',
        ];
        $statusLabel = $statusMap[$rentalRequest->status] ?? $rentalRequest->status;

        $this->create(
            $rentalRequest->user_id,
            'rental_status_updated',
            'Status Sewa Diperbarui',
            "Pengajuan sewa {$rentalRequest->vehicle->title} telah {$statusLabel}.",
            ['rental_request_id' => $rentalRequest->id, 'status' => $rentalRequest->status]
        );

        $this->create(
            $rentalRequest->vehicle->owner_id,
            'rental_status_updated',
            'Status Sewa Diperbarui',
            "Pengajuan sewa {$rentalRequest->vehicle->title} telah {$statusLabel}.",
            ['rental_request_id' => $rentalRequest->id, 'status' => $rentalRequest->status]
        );
    }

    public function vehicleReported(Vehicle $vehicle): void
    {
        $this->create(
            $vehicle->owner_id,
            'vehicle_reported',
            'Kendaraan Dilaporkan',
            "Kendaraan {$vehicle->title} telah dilaporkan dan sedang ditinjau.",
            ['vehicle_id' => $vehicle->id]
        );
    }
}

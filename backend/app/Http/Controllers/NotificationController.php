<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($request->per_page ?? 15);

        $unreadCount = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        $meta = $this->paginationMeta($notifications);
        $meta['unread_count'] = $unreadCount;

        return $this->successResponse(
            $notifications->items(),
            'Daftar notifikasi berhasil diambil',
            200,
            $meta
        );
    }

    public function markAsRead($id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return $this->successResponse($notification, 'Notifikasi ditandai sudah dibaca');
    }

    public function markAllAsRead(Request $request): JsonResponse
    {
        Notification::where('user_id', $request->user()->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return $this->successResponse(null, 'Semua notifikasi ditandai sudah dibaca');
    }
}

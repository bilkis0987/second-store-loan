<?php

namespace App\Services;

use App\Models\DeviceToken;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class FcmService
{
    public function send(string $title, string $body, array $data = [], $userId = null): int
    {
        $query = DeviceToken::query();

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $tokens = $query->pluck('token')->toArray();

        if (empty($tokens)) {
            return 0;
        }

        try {
            Log::info('FCM Notification', [
                'title' => $title,
                'body' => $body,
                'data' => $data,
                'tokens' => $tokens,
            ]);
        } catch (\Exception $e) {
            Log::error('FCM send failed: ' . $e->getMessage());
        }

        return 0;
    }
}

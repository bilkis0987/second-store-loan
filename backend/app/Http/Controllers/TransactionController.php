<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = Transaction::with([
            'vehicle:id,title,thumbnail',
            'buyer:id,name',
            'seller:id,name',
        ]);

        if ($user->role === 'admin') {
            // admin sees all
        } elseif (in_array($user->role, ['seller', 'rental'])) {
            $query->where('seller_id', $user->id);
        } else {
            $query->where('buyer_id', $user->id);
        }

        if ($request->filled('type')) {
            $query->where('transaction_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('transaction_status', $request->status);
        }

        $query->orderBy('created_at', 'desc');
        $perPage = $request->per_page ?? 15;
        $transactions = $query->paginate($perPage);

        return $this->successResponse(
            $transactions->items(),
            'Daftar transaksi berhasil diambil',
            200,
            $this->paginationMeta($transactions)
        );
    }

    public function show($id): JsonResponse
    {
        $transaction = Transaction::with([
            'vehicle:id,title,thumbnail,price,description,location,year',
            'vehicle.owner:id,name,phone',
            'buyer:id,name,phone',
            'seller:id,name,phone',
        ])->findOrFail($id);

        return $this->successResponse($transaction, 'Detail transaksi berhasil diambil');
    }
}

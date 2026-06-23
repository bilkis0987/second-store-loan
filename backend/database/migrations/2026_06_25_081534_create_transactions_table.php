<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rental_request_id')->nullable()->constrained('rental_requests')->onDelete('set null');
            $table->string('transaction_type', 10);
            $table->decimal('amount', 15, 2);
            $table->string('payment_status', 20)->default('pending');
            $table->string('transaction_status', 20)->default('pending');
            $table->timestamps();

            $table->index(['buyer_id', 'transaction_type']);
            $table->index(['seller_id', 'transaction_type']);
            $table->index('transaction_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

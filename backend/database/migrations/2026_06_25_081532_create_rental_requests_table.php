<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('rental_start_date');
            $table->date('rental_end_date');
            $table->integer('total_days');
            $table->decimal('total_price', 15, 2);
            $table->text('note')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->index(['vehicle_id', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_requests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('vehicle_brands')->onDelete('restrict');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category', 100);
            $table->string('transaction_type', 10);
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('rental_price_daily', 15, 2)->nullable();
            $table->decimal('rental_price_weekly', 15, 2)->nullable();
            $table->decimal('rental_price_monthly', 15, 2)->nullable();
            $table->integer('year');
            $table->string('color', 50);
            $table->string('transmission', 10);
            $table->string('fuel_type', 20);
            $table->integer('mileage');
            $table->string('location');
            $table->text('description');
            $table->string('status', 20)->default('pending');
            $table->string('thumbnail');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('transaction_type');
            $table->index('category');
            $table->index(['owner_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

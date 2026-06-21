<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_id',
        'brand_id',
        'title',
        'slug',
        'category',
        'transaction_type',
        'price',
        'rental_price_daily',
        'rental_price_weekly',
        'rental_price_monthly',
        'year',
        'color',
        'transmission',
        'fuel_type',
        'mileage',
        'location',
        'description',
        'status',
        'thumbnail',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rental_price_daily' => 'decimal:2',
        'rental_price_weekly' => 'decimal:2',
        'rental_price_monthly' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(VehicleBrand::class, 'brand_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function purchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class);
    }

    public function rentalRequests(): HasMany
    {
        return $this->hasMany(RentalRequest::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function adminVerifications(): HasMany
    {
        return $this->hasMany(AdminVerification::class);
    }
}

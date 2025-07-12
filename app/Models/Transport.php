<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'transports';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'transport_type',
        'company_name',
        'vehicle_details',
        'capacity',
        'amenities',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'capacity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get transport tours (many-to-many through tour_transport).
     */
    public function tourTransports()
    {
        return $this->hasMany(TourTransport::class, 'transport_id', 'id');
    }

    /**
     * Get tours that use this transport.
     */
    public function tours()
    {
        return $this->hasManyThrough(
            Tour::class,
            TourTransport::class,
            'transport_id', // Foreign key on tour_transport table
            'tour_id',      // Foreign key on tours table
            'id',           // Local key on transport table (changed from 'transport_id')
            'tour_id'       // Local key on tour_transport table
        );
    }

    /**
     * Get formatted capacity with "people" suffix.
     */
    public function getFormattedCapacityAttribute(): string
    {
        return $this->capacity . ' people';
    }

    /**
     * Get short vehicle details for display.
     */
    public function getShortVehicleDetailsAttribute(): string
    {
        return strlen($this->vehicle_details) > 50
            ? substr($this->vehicle_details, 0, 50) . '...'
            : $this->vehicle_details;
    }

    /**
     * Get display name combining type and company.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->transport_type . ' - ' . $this->company_name;
    }

    /**
     * Scope to filter by transport type.
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('transport_type', $type);
    }

    /**
     * Scope to filter by minimum capacity.
     */
    public function scopeMinCapacity($query, int $minCapacity)
    {
        return $query->where('capacity', '>=', $minCapacity);
    }

    /**
     * Scope to search by company name or transport type.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where('company_name', 'like', '%' . $search . '%')
                    ->orWhere('transport_type', 'like', '%' . $search . '%')
                    ->orWhere('vehicle_details', 'like', '%' . $search . '%');
    }

    /**
     * Get common transport types for safari/tours.
     */
    public static function getCommonTypes(): array
    {
        return [
            'Safari Vehicle' => 'Safari Vehicle',
            'Bus' => 'Bus',
            'Mini Bus' => 'Mini Bus',
            'SUV' => 'SUV',
            'Land Cruiser' => 'Land Cruiser',
            'Boat' => 'Boat',
            'Aircraft' => 'Aircraft',
            'Helicopter' => 'Helicopter',
            'Walking' => 'Walking Safari',
            'Horseback' => 'Horseback',
        ];
    }

    /**
     * Check if transport has high capacity (>20 people).
     */
    public function getIsHighCapacityAttribute(): bool
    {
        return $this->capacity > 20;
    }

    /**
     * Get amenities as array (if stored as comma-separated).
     */
    public function getAmenitiesArrayAttribute(): array
    {
        return $this->amenities ? explode(',', $this->amenities) : [];
    }
}

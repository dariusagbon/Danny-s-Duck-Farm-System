<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type',
        'item_id',
        'action',
        'quantity_change',
        'quantity_before',
        'quantity_after',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'quantity_change' => 'decimal:2',
        'quantity_before' => 'decimal:2',
        'quantity_after' => 'decimal:2',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->morphTo();
    }

    // Accessors
    public function getFormattedActionAttribute(): string
    {
        return match($this->action) {
            'added' => 'Stock Added',
            'sold' => 'Stock Sold',
            'adjusted' => 'Stock Adjusted',
            default => ucfirst($this->action)
        };
    }

    public function getChangeTypeAttribute(): string
    {
        return $this->quantity_change > 0 ? 'increase' : 'decrease';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class feeds extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'current_stock',
        'min_stock_level',
        'unit', // 'kg', 'bags', 'tons', etc.
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'current_stock' => 'decimal:2',
        'min_stock_level' => 'decimal:2',
    ];

    // Relationships
    public function inventoryLogs(): HasMany
    {
        return $this->hasMany(InventoryLog::class, 'item_id')->where('item_type', self::class);
    }

    // Accessors
    public function getIsLowStockAttribute(): bool
    {
        return $this->current_stock <= $this->min_stock_level;
    }

    // Methods
    public function adjustStock(float $quantity, string $action, string $notes = null, int $userId = null): void
    {
        $oldStock = $this->current_stock;
        $this->current_stock += $quantity;
        $this->save();

        // Log the inventory change
        InventoryLog::create([
            'item_type' => self::class,
            'item_id' => $this->id,
            'action' => $action,
            'quantity_change' => $quantity,
            'quantity_before' => $oldStock,
            'quantity_after' => $this->current_stock,
            'notes' => $notes,
            'user_id' => $userId ?? auth()->id(),
        ]);
    }
}

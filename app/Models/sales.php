<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_trays',
        'total_eggs_sold',
        'selling_price',
        'gross_income',
        'total_expenses',
        'net_income',
        'month_of',
        'customer_id',
        'notes',
    ];

    protected $casts = [
        'month_of' => 'date',
        'selling_price' => 'decimal:2',
        'gross_income' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'net_income' => 'decimal:2',
        'total_trays' => 'integer',
        'total_eggs_sold' => 'integer',
    ];

    // Relationships
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Boot method to handle automatic calculations
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($sale) {
            // Auto-calculate gross income
            $sale->gross_income = $sale->total_eggs_sold * $sale->selling_price;

            // Auto-calculate net income
            $sale->net_income = $sale->gross_income - $sale->total_expenses;

            // Deduct from inventory if this is newly created
            if (!$sale->exists) {
                $sale->deductFromInventory();
            }
        });
    }

    // Methods
    public function deductFromInventory(): void
    {
        $remaining = $this->total_eggs_sold;
        $eggBatches = Eggs::where('current_stock', '>', 0)
            ->orderBy('date', 'asc')
            ->get();

        if ($eggBatches->sum('current_stock') < $remaining) {
            throw ValidationException::withMessages([
                'total_eggs_sold' => 'Not enough egg stock available to complete this sale.',
            ]);
        }

        DB::transaction(function () use (&$remaining, $eggBatches) {
            foreach ($eggBatches as $batch) {
                if ($remaining <= 0) {
                    break;
                }

                $deduct = min($batch->current_stock, $remaining);
                $batch->adjustStock(-$deduct, 'sold', "Sale ID: {$this->id}");
                $remaining -= $deduct;
            }
        });
    }

    // Accessors
    public function getProfitMarginAttribute(): float
    {
        return $this->gross_income > 0 ? ($this->net_income / $this->gross_income) * 100 : 0;
    }
}

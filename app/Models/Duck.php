<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Duck extends Model
{
    protected $fillable = [
        'name',
        'age',
        'breed',
        'hatch_date',
        'status',
    ];

    protected $casts = [
        'hatch_date' => 'date',
    ];

    // Optional: Calculate current age in weeks
    public function getCurrentAgeAttribute()
    {
        return Carbon::parse($this->hatch_date)->diffInWeeks(now());
    }
}

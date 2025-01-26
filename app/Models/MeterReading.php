<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\MeterType;

class MeterReading extends Model
{
    protected $fillable = [
        'meter_type',
        'reading',
        'reading_at',
    ];

    public function casts(): array
    {
        return [
            'meter_type' => MeterType::class,
            'reading_at' => 'datetime',
        ];
    }
}

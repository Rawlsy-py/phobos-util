<?php

namespace App\Enum;

enum MeterType: string
{
    case Electric = 'electric';
    case Gas = 'gas';
    case Water = 'water';

    public function label(): string
    {
        return match ($this) {
            self::Electric => __('Electric'),
            self::Gas => __('Gas'),
            self::Water => __('Water'),
        };
    }
}
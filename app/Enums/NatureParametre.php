<?php

namespace App\Enums;

enum NatureParametre: string
{
    case MONEY = 'Money';
    case POINTS = 'Points';
    case LEVEL = 'Level';

    public function getType(): string
    {
        return match ($this) {
            self::MONEY => 'float',
            self::POINTS, self::LEVEL => 'integer',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MONEY => 'Argent',
            self::POINTS => 'Points',
            self::LEVEL => 'Niveau',
        };
    }
}
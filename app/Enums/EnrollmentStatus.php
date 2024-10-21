<?php

namespace App\Enums;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum EnrollmentStatus: string implements HasIcon, HasColor
{
    case ACTIVE = "active";
    case DROPPED = "dropped";
    case COMPLETED = "completed";

    public function getIcon(): string
    {
        return match($this){
            self::ACTIVE => 'heroicon-o-check-circle',
            self::DROPPED => 'heroicon-o-pause-circle',
            self::COMPLETED => 'heroicon-o-check-badge',
        };
    }

    public function getColor(): string | array
    {
        return match($this){
            self::ACTIVE => Color::Green,
            self::DROPPED => Color::Gray,
            self::COMPLETED => Color::Indigo,
        };
    }
}

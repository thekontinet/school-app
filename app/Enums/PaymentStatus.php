<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum PaymentStatus: string implements HasColor, HasIcon
{
    case PENDING = "pending";
    case COMPLETE = "complete";

    public function getColor(): array|string|null
    {
        return match($this)
        {
            self::PENDING => Color::Gray,
            self::COMPLETE => Color::Green,
        };
    }

    public function getIcon(): string
    {
        return match($this)
        {
            self::PENDING => 'heroicon-o-exclamation-circle',
            self::COMPLETE =>'heroicon-o-check-badge',
        };
    }
}

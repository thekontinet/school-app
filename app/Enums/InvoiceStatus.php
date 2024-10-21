<?php

namespace App\Enums;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum InvoiceStatus: string implements HasColor, HasIcon, HasLabel
{
    case PENDING = "pending";
    case PARTIALLY = "partial_payment";
    case OVERPAID = "over_paid";
    case PAID = "paid";

    public function getColor(): array|string|null
    {
        return match($this)
        {
            self::PENDING => Color::Gray,
            self::PARTIALLY => Color::Amber,
            self::OVERPAID => Color::Red,
            self::PAID => Color::Green,
        };
    }

    public function getIcon(): string
    {
        return match($this)
        {
            self::PENDING => 'heroicon-o-exclamation-circle',
            self::PARTIALLY => 'heroicon-o-information-circle',
            self::OVERPAID => 'heroicon-o-exclamation-circle',
            self::PAID =>'heroicon-o-check-badge',
        };
    }

    public function getLabel(): string
    {
        return match($this)
        {
            self::PARTIALLY => 'partly paid',
            default => $this->value
        };
    }
}

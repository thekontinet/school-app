<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case  CASH = 'cash';
    case  BANK_TRANSFER = 'bank_transfer';
    case  CARD = 'card';

    public function getLabel(): ?string
    {
        return match($this){
            self::BANK_TRANSFER => 'Bank Transfer',
            default => ucfirst( $this->value)
        };
    }
}

<?php

namespace App\Enums;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum PublishStatus: string implements HasIcon, HasColor
{
    case DRAFT = "draft";
    case PUBLISH = "publish";

    public function getIcon(): string
    {
        return match($this){
            self::DRAFT => 'heroicon-o-ellipsis-horizontal-circle',
            self::PUBLISH => 'heroicon-o-check-badge',
        };
    }

    public function getColor(): string | array
    {
        return match($this){
            self::DRAFT => Color::Amber,
            self::PUBLISH => Color::Green,
        };
    }
}

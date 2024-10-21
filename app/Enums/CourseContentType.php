<?php

namespace App\Enums;
use Filament\Support\Contracts\HasIcon;

enum CourseContentType: string implements HasIcon
{
    case Text = 'text';
    case Video = 'video';
    case PDF = 'pdf';
    case QUIZ = 'quiz';
    case ASSIGNMENT = 'assignment';

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Text => 'heroicon-o-document-text',
            self::Video => 'heroicon-o-film',
            self::PDF => 'heroicon-o-document',
            self::QUIZ => 'heroicon-o-puzzle-piece',
            self::ASSIGNMENT => 'heroicon-o-sparkles',
        };
    }
}

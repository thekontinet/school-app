<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use App\Filament\Resources\EnrollmentResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    public function form(Form $form): Form
    {
        return EnrollmentResource::form($form);
    }

    public function table(Table $table): Table
    {
        return EnrollmentResource::table($table);
    }
}

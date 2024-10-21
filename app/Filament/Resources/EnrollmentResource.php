<?php

namespace App\Filament\Resources;

use App\Enums\EnrollmentStatus;
use App\Filament\Resources\EnrollmentResource\Pages;
use App\Filament\Resources\EnrollmentResource\RelationManagers\InvoiceRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\EnrollmentsRelationManager;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship(
                        'student',
                        'firstname',
                    )
                    ->required(),

                Forms\Components\Select::make('course_id')
                    ->relationship(
                        'course',
                        'title'
                    )
                    ->live()
                    ->required(),

                Forms\Components\Hidden::make('status')
                    ->default(EnrollmentStatus::ACTIVE)
                    ->required(),

                Forms\Components\Radio::make('plan_id')
                    ->label('Plan')
                    ->options(fn($get) => Course::find($get('course_id'))?->plans()->pluck('name', 'id'))
                    ->descriptions(fn($get) => Course::find($get('course_id'))?->plans()->pluck('description', 'id'))
                    ->visible(fn($get) => Course::find($get('course_id'))?->plans()->exists())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.reg_no')
                    ->description(fn(Enrollment $record) => $record->student->full_name)
                    ->searchable()
                    ->url(fn(Enrollment $record) =>StudentResource::getUrl('edit', ['record' => $record->student])),
                Tables\Columns\TextColumn::make('course.title'),
                Tables\Columns\TextColumn::make('plan.name'),
                Tables\Columns\TextColumn::make('status')
                    ->icon(fn($state) => $state->getIcon()),
                Tables\Columns\TextColumn::make('enrolled_at')->dateTime('jS M y h:i a')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('completed_at')->dateTime('jS M y h:i a')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('view')
                        ->url(fn($record) => EnrollmentResource::getUrl('view', ['record' => $record]))
                        ->icon('heroicon-o-eye'),

                    Tables\Actions\Action::make('generate_invoice')
                        ->action(function(Enrollment $record, Tables\Actions\Action $action){
                            $record->createInvoice();
                            $action->sendSuccessNotification();
                        })
                        ->hidden(fn(Enrollment $record) => $record->invoices()->exists())
                        ->icon('heroicon-o-document-text')
                    ->successNotificationMessage('Invoice generated'),
                    Tables\Actions\DeleteAction::make()
                        ->hidden(fn(Enrollment $record) => $record->invoices()->exists()),
                ])
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InvoiceRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'view' => Pages\ViewEnrollment::route('/{record}'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\RelationManagers\InvoiceRelationManager;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers\EnrollmentsRelationManager;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->persistTabInQueryString()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\FileUpload::make('passport')
                                    ->avatar()
                                    ->hiddenLabel(),

                                Forms\Components\TextInput::make('firstname')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex. John')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('middle_name')
                                    ->maxLength(255)
                                    ->placeholder('Ex. Maxwell')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('lastname')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex. Doe')
                                    ->columnSpanFull(),

                                Forms\Components\Select::make('gender')
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ])
                                    ->required(),

                                Forms\Components\DatePicker::make('date_of_birth'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Contact Information')
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('student@example.com'),

                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->prefix('+234')
                                    ->placeholder('9012345678')
                                    ->requiredIf('email', null)
                                    ->maxLength(10)
                                    ->extraInputAttributes(['maxlength' => 10])
                                    ->validationMessages(['required_unless' => 'Please provide an email or phone number'])
                                    ->dehydrateStateUsing(fn($state) => $state ? str_pad($state, 13, '234', STR_PAD_LEFT) : $state)
                                    ->formatStateUsing(fn($state) => $state ? substr($state, 3, 10) : $state),

                                Forms\Components\Repeater::make('address')
                                    ->addable(false)
                                    ->deletable(false)
                                    ->reorderable(false)
                                    ->columns(3)
                                    ->schema([
                                        Forms\Components\TextInput::make('country')
                                            ->placeholder('Ex. Nigeria')
                                            ->default('Nigeria')
                                            ->required(),

                                        Forms\Components\TextInput::make('state')
                                            ->placeholder('Ex. Delta')
                                            ->required(),

                                        Forms\Components\TextInput::make('city')
                                            ->placeholder('Your city')
                                            ->required(),

                                        Forms\Components\TextInput::make('address')
                                            ->placeholder('Ex. No 10 fake street')
                                            ->required()
                                            ->columnSpanFull()
                                    ])
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('passport')
                    ->circular()
                    ->grow(false)
                    ->label(''),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reg_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->url(fn($state) => $state ? "mailto:$state" : null)
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->prefix('+')
                    ->url(fn($state) => $state ? "tel:$state" : null)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registration Date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EnrollmentsRelationManager::class,
            InvoiceRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}

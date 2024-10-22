<?php

namespace App\Filament\Resources;

use App\Enums\PaymentMethod;
use App\Exceptions\PaymentError;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('due_date')
                    ->required()
                    ->minDate(now()->startOfDay())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->url(fn($record) => self::getUrl('show', compact('record'))),
                Tables\Columns\TextColumn::make('amount')->money('NGN')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('amount_due')->money('NGN'),
                Tables\Columns\TextColumn::make('amount_paid')->money('NGN')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('due_date')->date('jS M Y'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('record payment')
                        ->icon('heroicon-o-banknotes')
                        ->form([
                            Forms\Components\TextInput::make('amount')
                                ->prefix('NGN')
                                ->numeric()
                                ->required(),

                            Forms\Components\Select::make('method')
                                ->options(PaymentMethod::class)
                                ->required(),
                        ])
                        ->action(function(Invoice $record, array $data){
                            try{
                                $record->addPayment($data['amount'], PaymentMethod::from($data['method']));
                            }catch (PaymentError $error){
                                Log::error($error);
                                Notification::make()
                                    ->danger()
                                    ->title('Invoice Error')
                                    ->body($error->getMessage())
                                    ->send();
                            }
                        }),
                ])
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
            RelationManagers\PaymentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'show' => Pages\ViewInvoice::route('/{record}'),
        ];
    }
}

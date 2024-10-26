<?php

namespace App\Filament\Resources\EnrollmentResource\RelationManagers;

use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceRelationManager extends RelationManager
{
    protected static string $relationship = 'Invoices';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        $unpaidInvoicesCount = $ownerRecord->invoices()->whereNot('invoices.status', InvoiceStatus::PAID)->count();
        return $unpaidInvoicesCount > 0 ? $unpaidInvoicesCount : null;
    }

    public function table(Table $table): Table
    {
        return InvoiceResource::table($table);
    }
}

<?php

namespace App\Observers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\Plan;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     */
    public function creating(Invoice $invoice): void
    {
        $invoice->amount_due = $invoice->amount_due ?? $invoice->amount;
        $invoice->number = $invoice->number ?? str_pad(Invoice::query()->max('id') + 1, 8, '0', STR_PAD_LEFT);
        $invoice->status = $invoice->status ?? InvoiceStatus::PENDING;
    }
}

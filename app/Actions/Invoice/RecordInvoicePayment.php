<?php

namespace App\Actions\Invoice;
use App\Enums\PaymentMethod;
use App\Models\Interfaces\Payable;
use App\Models\Invoice;

class RecordInvoicePayment
{
    /**
     * Create a new class instance.
     */
    public function handle(Invoice $invoice, PaymentMethod $paymentMethod)
    {
        return $invoice->payment()->create([
            'payer_type' => $invoice->owner_type,
            'payer_id' => $invoice->owner_id,
            'amount' => $invoice->amount,
            'method' => $paymentMethod ,
        ]);
    }
}

<?php

namespace App\Models\Traits;
use App\Enums\PaymentMethod;
use App\Models\Interfaces\Billable;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanPay
{
    public function createPayment(Invoice $invoice, PaymentMethod $method): Payment
    {
        return $this->payments()->create([
            'payable_type' => get_class($invoice),
            'payable_id' => $invoice->getKey(),
            'amount' => $invoice->amount,
            'method' => $method,
        ]);
    }

    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payer');
    }
}

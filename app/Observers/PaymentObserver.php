<?php

namespace App\Observers;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Str;

class PaymentObserver
{

    public function creating(Payment $payment)
    {
        $payment->reference = $payment->reference ?? str_pad(Payment::query()->max('id') + 1, 8, "0", STR_PAD_LEFT);
        $payment->status = $payment->status ?? PaymentStatus::PENDING;
    }

    public function saved(Payment $payment)
    {
        $payment->invoice->updateCalculations();
    }

    public function deleted(Payment $payment)
    {
        $payment->invoice->updateCalculations();
    }

}

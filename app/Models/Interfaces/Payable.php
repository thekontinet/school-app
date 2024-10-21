<?php

namespace App\Models\Interfaces;
use App\Enums\PaymentMethod;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Payable
{
    public function payments(): MorphMany;
    public function createPayment(Invoice $invoice, PaymentMethod $method): Payment;
}

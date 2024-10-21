<?php

namespace App\Models\Interfaces;
use App\Enums\PaymentMethod;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Billable
{
    public function createInvoice(): Collection;
    public function invoices(): HasMany;
}

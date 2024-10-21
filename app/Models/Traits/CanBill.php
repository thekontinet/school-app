<?php

namespace App\Models\Traits;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanBill
{
    /**
     * Create a new class instance.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function createInvoice(): Collection
    {
        $this->load(['student', 'course']);

        $data = [];
        $dueDate = now(); // Set the first installment's due date to today
        $installmentAmount = $this->plan->total_amount / $this->plan->installment_count;
        $incrementDuration = $this->course->duration_in_weeks / $this->plan->installment_count;

        for ($i = 1; $i <= $this->plan->installment_count; $i++) {
            $data[] = [
                'amount' => $installmentAmount,
                'due_date' => $i === 1 ? $dueDate : (clone $dueDate)->addWeeks($incrementDuration * ($i - 1))->endOfDay(),
                'status' => InvoiceStatus::PENDING,
            ];
        }

        return $this->invoices()->createMany($data);
    }

}

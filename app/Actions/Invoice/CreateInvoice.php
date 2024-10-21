<?php

namespace App\Actions\Invoice;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Support\Collection;

class CreateInvoice
{
    /**
     * Create a new class instance.
     */
    public function handle(Plan $plan, Student $student): Collection
    {
        $invoices = Collection::make();
        for ($i = 1; $i <= $plan->installments; $i++) {
            $invoice = Invoice::create([
                'plan_id' => $plan->id,
                'owner_type' => get_class($student),
                'owner_id' => $student->id,
                'billable_type' => $plan->planable_type,
                'billable_id' => $plan->planable_id,
                'amount' => $plan->total_amount / $plan->installments,
                'due_date' => now()->addMonths($i - 1)->endOfDay(),
                'status' => 'unpaid'
            ]);

            $invoices->add($invoice);
        }

        return $invoices;
    }
}

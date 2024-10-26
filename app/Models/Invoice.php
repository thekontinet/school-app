<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Exceptions\PaymentError;
use App\Observers\InvoiceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

#[ObservedBy(InvoiceObserver::class)]
class Invoice extends Model
{
    use HasFactory;

    protected function casts()
    {
        return [
            'status' => InvoiceStatus::class
        ];
    }

    public function addPayment(float $amount, PaymentMethod $method)
    {
        if($this->status === InvoiceStatus::PAID) throw new PaymentError("Invoice already settled");

        if($amount > $this->amount_due) throw new PaymentError("The specified amount will result to an overpaid invoice");

        return DB::transaction(function () use ($amount, $method) {
            // Create a new payment record
            $payment = $this->payments()->create([
                'amount' => $amount,
                'reference' => str_pad($this->payments()->max('id') + 1, 8, "0", STR_PAD_LEFT),
                'paid_at' => now(),
                'method' => $method,
                'status' => PaymentStatus::COMPLETE,
            ]);

            return $payment;
        });
    }

    public function updateCalculations()
    {
        return $this->update([
            'amount_due' => $this->amount - $this->payments()->sum('amount'),
            'status' => $this->getStatus()
        ]);
    }

    private function getStatus(): InvoiceStatus
    {
        // Update the invoice status based on total payments
        $totalPayment = $this->payments()->sum('amount');

        // Determine the new invoice status
        return match (true) {
            $totalPayment == $this->amount => InvoiceStatus::PAID,
            $totalPayment > 0 && $totalPayment < $this->amount => InvoiceStatus::PARTIALLY,
            $totalPayment > $this->amount => InvoiceStatus::OVERPAID,
            default => InvoiceStatus::PENDING,
        };
    }

    public function amountPaid(): Attribute
    {
        return new Attribute(
            fn() => $this->amount - $this->amount_due
        );
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

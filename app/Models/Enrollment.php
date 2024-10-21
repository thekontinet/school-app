<?php

namespace App\Models;

use App\Enums\EnrollmentStatus;
use App\Models\Interfaces\Billable;
use App\Models\Traits\CanBill;
use App\Observers\EnrollmentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(EnrollmentObserver::class)]
class Enrollment extends Model implements Billable
{
    use HasFactory, canBill;
    const UPDATED_AT = null;
    const CREATED_AT = 'enrolled_at';

    protected function casts(): array
    {
        return [
            'status' => EnrollmentStatus::class
        ];
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class);
    }
}

<?php

namespace App\Observers;
use App\Models\Enrollment;

class EnrollmentObserver
{
    public function created(Enrollment $enrollment)
    {
        $enrollment->createInvoice();
    }
}

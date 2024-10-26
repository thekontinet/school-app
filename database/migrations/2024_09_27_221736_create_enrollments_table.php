<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('course_id');
            $table->foreignId('plan_id');
            $table->string('status');
            $table->dateTime('enrolled_at');
            $table->dateTime('completed_at')->nullable();

            $table->unique(['course_id', 'student_id']);
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->constrained('enrollments')->cascadeOnDelete();
            $table->string('number')->unique();
            $table->decimal('amount', 10, 2);
            $table->decimal('amount_due', 10, 2);
            $table->dateTime('due_date');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id');
            $table->decimal('amount', 10, 2);
            $table->string('reference');
            $table->string('method');
            $table->dateTime('paid_at')->nullable();
            $table->string('status')->default('pending'); // 'pending', 'completed', 'failed'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('enrollments');
    }
};

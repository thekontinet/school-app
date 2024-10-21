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
        Schema::create('students', function (Blueprint $table) {
            // primary info
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('reg_no')->unique();
            $table->string('prefix')->nullable();
            $table->string('firstname');
            $table->string('middle_name')->nullable();
            $table->string('lastname');
            $table->string('gender');

            // contact info
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->json('address')->nullable();

            // secondary
            $table->date('date_of_birth')->nullable();
            $table->text('passport')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

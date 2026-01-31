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
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->dateTime('scheduled_date');
            $table->enum('interview_type', ['phone', 'video', 'in_person']);
            $table->text('notes')->nullable();
            $table->foreignId('interviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('duration')->nullable()->comment('Duration in minutes');
            $table->string('location')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'rescheduled', 'cancelled'])->default('scheduled');
            $table->text('feedback')->nullable();
            // FIXED: Changed from integer to enum for pass/fail
            $table->enum('rating', ['pass', 'fail'])->nullable()->comment('Interview result: pass or fail');
            $table->timestamps();

            $table->index(['scheduled_date', 'status']);
            $table->index('applicant_id');
            $table->index('interviewer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};

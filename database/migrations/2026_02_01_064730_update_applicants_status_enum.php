<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL
        DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'interview_rescheduled', 'interview_passed', 'interview_failed', 'accepted', 'rejected') NOT NULL DEFAULT 'pending'");

        // For PostgreSQL (if you're using PostgreSQL)
        // DB::statement("ALTER TABLE applicants ALTER COLUMN status TYPE VARCHAR(255)");
        // DB::statement("ALTER TABLE applicants ADD CONSTRAINT applicants_status_check CHECK (status IN ('pending', 'under_review', 'interview_scheduled', 'interview_rescheduled', 'interview_passed', 'interview_failed', 'accepted', 'rejected'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original values
        DB::statement("ALTER TABLE applicants MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'accepted', 'rejected') NOT NULL DEFAULT 'pending'");

        // For PostgreSQL
        // DB::statement("ALTER TABLE applicants DROP CONSTRAINT applicants_status_check");
        // DB::statement("ALTER TABLE applicants ALTER COLUMN status TYPE VARCHAR(255)");
        // DB::statement("ALTER TABLE applicants ADD CONSTRAINT applicants_status_check CHECK (status IN ('pending', 'under_review', 'interview_scheduled', 'accepted', 'rejected'))");
    }
};

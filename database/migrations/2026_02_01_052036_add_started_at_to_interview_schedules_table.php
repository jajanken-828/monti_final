<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartedAtToInterviewSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->dropColumn('started_at');
        });
    }
}

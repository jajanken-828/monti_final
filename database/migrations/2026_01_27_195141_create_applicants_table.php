
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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('street_address');
            $table->string('street_address_line2')->nullable();
            $table->string('city');
            $table->string('state_province');
            $table->string('postal_zip_code');
            $table->string('email');
            $table->string('phone_number');
            $table->string('linkedin_profile')->nullable();
            $table->string('position_applied');
            $table->string('referral_source');
            $table->date('available_start_date');
            $table->string('sss_file_path')->nullable();
            $table->string('philhealth_file_path')->nullable();
            $table->string('pagibig_file_path')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('notice_period')->nullable();
            $table->boolean('textile_experience')->default(false);
            $table->enum('status', ['pending', 'under_review', 'interview_scheduled', 'accepted', 'rejected'])->default('pending');
            $table->dateTime('interview_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};

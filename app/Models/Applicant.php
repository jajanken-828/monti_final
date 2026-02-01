<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'street_address',
        'street_address_line2',
        'city',
        'state_province',
        'postal_zip_code',
        'email',
        'phone_number',
        'linkedin_profile',
        'position_applied',
        'referral_source',
        'available_start_date',
        'sss_file_path',
        'philhealth_file_path',
        'pagibig_file_path',
        'expected_salary',
        'notice_period',
        'textile_experience',
        'status',
        'interview_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'available_start_date' => 'date',
        'interview_date' => 'datetime',
        'textile_experience' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the interview schedules for the applicant.
     */
    public function interviewSchedules()
    {
        return $this->hasMany(InterviewSchedule::class);
    }

    /**
     * Get the latest interview schedule.
     */
    public function latestInterview()
    {
        return $this->hasOne(InterviewSchedule::class)->latestOfMany();
    }

    /**
     * Accessor for full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $fullName = $this->first_name;

        if ($this->middle_name) {
            $fullName .= ' '.$this->middle_name;
        }

        $fullName .= ' '.$this->last_name;

        return $fullName;
    }

    /**
     * Scope a query to filter by status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by position.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $position
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePosition($query, $position)
    {
        return $query->where('position_applied', $position);
    }

    /**
     * Scope a query to search by name or email.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%");
        });
    }

    /**
     * Check if applicant has any government documents uploaded.
     *
     * @return bool
     */
    public function hasGovernmentDocuments()
    {
        return ! empty($this->sss_file_path) ||
               ! empty($this->philhealth_file_path) ||
               ! empty($this->pagibig_file_path);
    }

    /**
     * Get the status badge class.
     *
     * @return string
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'pending' => 'badge-pending',
            'under_review' => 'badge-under-review',
            'interview_scheduled' => 'badge-interview',
            'interview_rescheduled' => 'badge-interview',
            'interview_passed' => 'badge-accepted',
            'interview_failed' => 'badge-rejected',
            'accepted' => 'badge-accepted',
            'rejected' => 'badge-rejected',
        ];

        return $classes[$this->status] ?? 'badge-pending';
    }

    /**
     * Get the formatted status.
     *
     * @return string
     */
    public function getFormattedStatusAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    /**
     * Get the formatted position applied.
     *
     * @return string
     */
    public function getFormattedPositionAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->position_applied));
    }

    /**
     * Check if applicant has upcoming interview.
     *
     * @return bool
     */
    public function hasUpcomingInterview()
    {
        return $this->interviewSchedules()
            ->where('status', 'scheduled')
            ->where('scheduled_date', '>', now())
            ->exists();
    }

    /**
     * Get next interview date.
     *
     * @return \Illuminate\Support\Carbon|null
     */
    public function getNextInterviewAttribute()
    {
        return $this->interviewSchedules()
            ->where('status', 'scheduled')
            ->where('scheduled_date', '>', now())
            ->orderBy('scheduled_date', 'asc')
            ->first();
    }
}

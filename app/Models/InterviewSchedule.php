<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'applicant_id',
        'scheduled_date',
        'interview_type',
        'notes',
        'interviewer_id',
        'duration',
        'location',
        'status',
        'feedback',
        'rating',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the applicant that owns the interview schedule.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    /**
     * Get the interviewer for the interview.
     */
    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }

    /**
     * Get the interview type label.
     *
     * @return string
     */
    public function getInterviewTypeLabelAttribute()
    {
        $labels = [
            'phone' => 'Phone Interview',
            'video' => 'Video Interview',
            'in_person' => 'In-Person Interview',
        ];

        return $labels[$this->interview_type] ?? $this->interview_type;
    }

    /**
     * Get the status badge class.
     *
     * @return string
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'scheduled' => 'badge-scheduled',
            'completed' => 'badge-completed',
            'rescheduled' => 'badge-rescheduled',
            'cancelled' => 'badge-cancelled',
        ];

        return $classes[$this->status] ?? 'badge-scheduled';
    }

    /**
     * Get the rating badge class.
     *
     * @return string
     */
    public function getRatingBadgeClassAttribute()
    {
        $classes = [
            'pass' => 'badge-completed',
            'fail' => 'badge-cancelled',
        ];

        return $classes[$this->rating] ?? 'badge-scheduled';
    }

    /**
     * Get the rating label.
     *
     * @return string
     */
    public function getRatingLabelAttribute()
    {
        $labels = [
            'pass' => 'Passed',
            'fail' => 'Failed',
        ];

        return $labels[$this->rating] ?? 'N/A';
    }

    /**
     * Get the formatted scheduled date.
     *
     * @return string
     */
    public function getFormattedScheduledDateAttribute()
    {
        return $this->scheduled_date->format('M d, Y h:i A');
    }

    /**
     * Check if interview is active (scheduled or rescheduled).
     *
     * @return bool
     */
    public function isActive()
    {
        return in_array($this->status, ['scheduled', 'rescheduled']);
    }

    /**
     * Check if interview is upcoming.
     *
     * @return bool
     */
    public function isUpcoming()
    {
        return $this->isActive() && $this->scheduled_date > now();
    }

    /**
     * Check if interview is past due.
     *
     * @return bool
     */
    public function isPastDue()
    {
        return $this->status === 'scheduled' && $this->scheduled_date < now();
    }

    /**
     * Check if interview is today.
     *
     * @return bool
     */
    public function isToday()
    {
        return $this->scheduled_date->isToday();
    }

    /**
     * Scope a query to only include active interviews (scheduled or rescheduled).
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['scheduled', 'rescheduled']);
    }

    /**
     * Scope a query to only include upcoming interviews.
     */
    public function scopeUpcoming($query)
    {
        return $query->whereIn('status', ['scheduled', 'rescheduled'])
            ->where('scheduled_date', '>', now());
    }

    /**
     * Scope a query to only include completed interviews.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include cancelled interviews.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to only include today's interviews.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_date', today())
            ->whereIn('status', ['scheduled', 'rescheduled']);
    }
}

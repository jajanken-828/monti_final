<?php

namespace App\Http\Controllers\uno\hrm\hrm_staff;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\InterviewSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterviewController extends Controller
{
    /**
     * Display interview schedule page
     */
    public function interviews()
    {
        // Get scheduled and rescheduled interviews with applicant data
        $interviews = InterviewSchedule::with('applicant')
            ->whereIn('status', ['scheduled', 'rescheduled']) // Only show scheduled and rescheduled
            ->orderBy('scheduled_date', 'asc')
            ->paginate(10);

        // Get today's interviews (scheduled and rescheduled only)
        $todayInterviews = InterviewSchedule::whereDate('scheduled_date', today())
            ->whereIn('status', ['scheduled', 'rescheduled'])
            ->count();

        // Get this week's interviews (next 7 days) - scheduled and rescheduled only
        $thisWeekInterviews = InterviewSchedule::whereBetween('scheduled_date', [today(), today()->addDays(7)])
            ->whereIn('status', ['scheduled', 'rescheduled'])
            ->count();

        // Get total scheduled and rescheduled interviews
        $totalScheduled = InterviewSchedule::whereIn('status', ['scheduled', 'rescheduled'])->count();

        // Get pending feedback (completed interviews without feedback)
        $pendingFeedback = InterviewSchedule::where('status', 'completed')
            ->whereNull('feedback')
            ->count();

        // Get today's interviews for the widget (scheduled and rescheduled only)
        $todayInterviewsList = InterviewSchedule::with('applicant')
            ->whereDate('scheduled_date', today())
            ->whereIn('status', ['scheduled', 'rescheduled'])
            ->orderBy('scheduled_date', 'asc')
            ->get();

        // Get upcoming interviews for the timeline (next 7 days) - scheduled and rescheduled only
        $upcomingInterviewsList = InterviewSchedule::with('applicant')
            ->whereBetween('scheduled_date', [today(), today()->addDays(7)])
            ->whereIn('status', ['scheduled', 'rescheduled'])
            ->orderBy('scheduled_date', 'asc')
            ->get();

        return view('uno.hrm.hrm_staff.interview', compact(
            'interviews',
            'todayInterviews',
            'thisWeekInterviews',
            'totalScheduled',
            'pendingFeedback',
            'todayInterviewsList',
            'upcomingInterviewsList'
        ));
    }

    /**
     * Get single interview details
     */
    public function getInterview($id)
    {
        $interview = InterviewSchedule::with('applicant')->findOrFail($id);

        return response()->json($interview);
    }

    /**
     * Mark interview as completed
     */
    public function completeInterview(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'feedback' => 'nullable|string|max:1000',
            'rating' => 'required|in:pass,fail',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $interview = InterviewSchedule::findOrFail($id);

        $interview->update([
            'status' => 'completed',
            'feedback' => $request->feedback,
            'rating' => $request->rating,
            'notes' => ($interview->notes ? $interview->notes."\n\n" : '').
                      'Interview completed on '.now()->format('Y-m-d H:i').
                      '. Result: '.($request->rating == 'pass' ? 'Passed' : 'Failed').
                      ($request->notes ? "\nAdditional Notes: ".$request->notes : ''),
        ]);

        // Update applicant status based on interview result
        $applicant = Applicant::find($interview->applicant_id);
        if ($applicant) {
            if ($request->rating == 'pass') {
                $applicant->update(['status' => 'interview_passed']);
            } else {
                $applicant->update(['status' => 'interview_failed']);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Interview marked as completed successfully!',
        ]);
    }

    /**
     * Start interview now (override schedule)
     */
    public function startInterviewNow($id)
    {
        $interview = InterviewSchedule::findOrFail($id);

        // Update interview time to now
        $interview->update([
            'scheduled_date' => now(),
            'notes' => ($interview->notes ? $interview->notes."\n\n" : '').
                      'Interview started immediately on '.now()->format('Y-m-d H:i').' (override scheduled time)',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Interview started successfully!',
            'interview' => $interview,
        ]);
    }

    /**
     * Reschedule interview
     */
    public function rescheduleInterview(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'scheduled_date' => 'required|date|after:now',
            'interview_type' => 'required|in:phone,video,in_person',
            'duration' => 'nullable|integer|min:15|max:240',
            'location' => 'nullable|string|max:255',
            'reschedule_reason' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $interview = InterviewSchedule::findOrFail($id);

        // Fix date issue: Ensure the date is saved correctly
        $scheduledDate = Carbon::parse($request->scheduled_date);

        $interview->update([
            'scheduled_date' => $scheduledDate,
            'interview_type' => $request->interview_type,
            'duration' => $request->duration,
            'location' => $request->location,
            'status' => 'rescheduled',
            'notes' => ($interview->notes ? $interview->notes."\n\n" : '').
                      'Rescheduled on '.now()->format('Y-m-d H:i').
                      '. Reason: '.$request->reschedule_reason.
                      '. New time: '.$scheduledDate->format('Y-m-d H:i'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Interview rescheduled successfully!',
        ]);
    }

    /**
     * Cancel interview
     */
    public function cancelInterview($id)
    {
        $interview = InterviewSchedule::findOrFail($id);

        $interview->update([
            'status' => 'cancelled',
            'notes' => ($interview->notes ? $interview->notes."\n\n" : '').
                      'Cancelled on '.now()->format('Y-m-d H:i'),
        ]);

        // Update applicant status
        $applicant = Applicant::find($interview->applicant_id);
        if ($applicant) {
            $applicant->update(['status' => 'under_review']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Interview cancelled successfully!',
        ]);
    }
}

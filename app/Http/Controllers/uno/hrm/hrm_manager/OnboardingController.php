<?php

namespace App\Http\Controllers\uno\hrm\hrm_manager;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\InterviewSchedule;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    /**
     * Display the onboarding dashboard
     */
    public function index()
    {
        // Get applicants for each pipeline stage
        $forInterviewApplicants = Applicant::whereIn('status', ['interview_scheduled', 'interview_rescheduled'])
            ->with(['latestInterview', 'interviewSchedules' => function ($query) {
                $query->where('status', 'scheduled')
                    ->where('scheduled_date', '>', now())
                    ->orderBy('scheduled_date', 'asc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $finalInterviewApplicants = Applicant::where('status', 'interview_passed')
            ->orderBy('updated_at', 'desc')
            ->get();

        $onboardingApplicants = Applicant::where('status', 'accepted')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get upcoming interviews
        $upcomingInterviews = InterviewSchedule::with(['applicant', 'interviewer'])
            ->where('status', 'scheduled')
            ->where('scheduled_date', '>=', now())
            ->orderBy('scheduled_date', 'asc')
            ->take(5)
            ->get();

        // Get recent applications
        $recentApplications = Applicant::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get statistics - REMOVED job_postings reference
        $stats = [
            'total_applicants' => Applicant::count(),
            'for_interview' => Applicant::whereIn('status', ['interview_scheduled', 'interview_rescheduled'])->count(),
            'interviews_scheduled' => InterviewSchedule::where('status', 'scheduled')
                ->where('scheduled_date', '>=', now())
                ->count(),
            'new_hires' => Applicant::where('status', 'accepted')
                ->whereMonth('updated_at', now()->month)
                ->count(),
        ];

        return view('uno.hrm.hrm_manager.onboarding', compact(
            'forInterviewApplicants',
            'finalInterviewApplicants',
            'onboardingApplicants',
            'upcomingInterviews',
            'recentApplications',
            'stats'
        ));
    }

    /**
     * Store new applicant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'street_address' => 'required|string|max:255',
            'street_address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state_province' => 'required|string|max:100',
            'postal_zip_code' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'phone_number' => 'required|string|max:20',
            'position_applied' => 'required|string|max:100',
            'status' => 'required|in:pending,under_review,interview_scheduled,interview_rescheduled,interview_passed,interview_failed,accepted,rejected',
            'notes' => 'nullable|string',
        ]);

        // Convert checkbox value to boolean
        $validated['textile_experience'] = $request->has('textile_experience');

        // Set default values for required fields not in form
        $validated['referral_source'] = 'Manual Entry';
        $validated['available_start_date'] = now()->addDays(30)->format('Y-m-d');
        $validated['linkedin_profile'] = null;
        $validated['expected_salary'] = null;
        $validated['notice_period'] = null;

        $applicant = Applicant::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Applicant added successfully',
            'applicant' => $applicant,
        ]);
    }

    /**
     * Update applicant status (drag and drop in kanban)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:interview_scheduled,interview_rescheduled,interview_passed,interview_failed,accepted,rejected',
        ]);

        $applicant = Applicant::findOrFail($id);
        $oldStatus = $applicant->status;
        $applicant->update(['status' => $request->status]);

        // If moving to accepted, set interview date if not set
        if ($request->status === 'accepted' && ! $applicant->interview_date) {
            $applicant->update(['interview_date' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Applicant status updated from '.str_replace('_', ' ', $oldStatus).' to '.str_replace('_', ' ', $request->status),
            'applicant' => $applicant->fresh(),
        ]);
    }

    /**
     * Get applicant details
     */
    public function show($id)
    {
        $applicant = Applicant::with(['interviewSchedules', 'latestInterview'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'applicant' => $applicant,
        ]);
    }

    /**
     * Get all upcoming interviews
     */
    public function getUpcomingInterviews()
    {
        $interviews = InterviewSchedule::with(['applicant', 'interviewer'])
            ->where('status', 'scheduled')
            ->where('scheduled_date', '>=', now())
            ->orderBy('scheduled_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'interviews' => $interviews,
        ]);
    }

    /**
     * Get dashboard statistics - UPDATED: Removed job_postings reference
     */
    public function getStatistics()
    {
        $stats = [
            'total_applicants' => Applicant::count(),
            'for_interview' => Applicant::whereIn('status', ['interview_scheduled', 'interview_rescheduled'])->count(),
            'interviews_scheduled' => InterviewSchedule::where('status', 'scheduled')
                ->where('scheduled_date', '>=', now())
                ->count(),
            'new_hires' => Applicant::where('status', 'accepted')
                ->whereMonth('updated_at', now()->month)
                ->count(),
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats,
        ]);
    }

    /**
     * Export applicants to CSV
     */
    public function exportCsv()
    {
        $applicants = Applicant::all();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="applicants_'.date('Y-m-d_H-i-s').'.csv"',
        ];

        $callback = function () use ($applicants) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID', 'Full Name', 'Email', 'Phone', 'Position Applied',
                'Status', 'Applied Date', 'Interview Date', 'Textile Experience',
            ]);

            // Add data rows
            foreach ($applicants as $applicant) {
                fputcsv($file, [
                    $applicant->id,
                    $applicant->full_name,
                    $applicant->email,
                    $applicant->phone_number,
                    $applicant->position_applied,
                    $applicant->formatted_status,
                    $applicant->created_at->format('Y-m-d'),
                    $applicant->interview_date ? $applicant->interview_date->format('Y-m-d') : 'N/A',
                    $applicant->textile_experience ? 'Yes' : 'No',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

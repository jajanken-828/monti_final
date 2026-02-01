<?php

namespace App\Http\Controllers\uno\hrm\hrm_staff;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\InterviewSchedule; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get applicants without scheduled interviews AND without final interview statuses
        $applicants = Applicant::whereDoesntHave('interviewSchedules', function ($query) {
            $query->where('status', 'scheduled');
        })
            ->whereNotIn('status', ['interview_passed', 'interview_failed'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalApplications = Applicant::count();
        $pendingReview = Applicant::where('status', 'pending')->count();
        $scheduledInterviews = Applicant::where('status', 'interview_scheduled')->count();
        $rejected = Applicant::where('status', 'rejected')->count();
        $interviewPassed = Applicant::where('status', 'interview_passed')->count();
        $interviewFailed = Applicant::where('status', 'interview_failed')->count();

        return view('uno.hrm.hrm_staff.application', compact(
            'applicants',
            'totalApplications',
            'pendingReview',
            'scheduledInterviews',
            'rejected',
            'interviewPassed',
            'interviewFailed'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);

        return response()->json($applicant);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(Request::all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_month' => 'required|numeric',
            'birth_day' => 'required|numeric',
            'birth_year' => 'required|numeric',
            'street_address' => 'required|string|max:500',
            'street_address_line2' => 'nullable|string|max:500',
            'city' => 'required|string|max:255',
            'state_province' => 'required|string|max:255',
            'postal_zip_code' => 'required|string|max:20',
            'email' => 'required|email|unique:applicants,email',
            'phone_number' => 'required|string|max:20',
            'linkedin_profile' => 'nullable|url',
            'position_applied' => 'required|string|max:255',
            'referral_source' => 'required|string|max:255',
            'available_start_date' => 'required|date',
            'sss_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'philhealth_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'pagibig_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'expected_salary' => 'nullable|string|max:100',
            'notice_period' => 'nullable|string|max:50',
            'textile_experience' => 'nullable|in:yes,no',
        ], [
            'email.unique' => 'This email address is already registered.',
            'available_start_date.date' => 'Please select a valid date.',
            'sss_file.max' => 'SSS file must not exceed 5MB.',
            'philhealth_file.max' => 'PhilHealth file must not exceed 5MB.',
            'pagibig_file.max' => 'Pag-IBIG file must not exceed 5MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Combine birth date
        $birthDate = sprintf('%04d-%02d-%02d',
            $request->birth_year,
            $request->birth_month,
            $request->birth_day
        );

        $applicantData = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $birthDate,
            'street_address' => $request->street_address,
            'street_address_line2' => $request->street_address_line2,
            'city' => $request->city,
            'state_province' => $request->state_province,
            'postal_zip_code' => $request->postal_zip_code,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'linkedin_profile' => $request->linkedin_profile,
            'position_applied' => $request->position_applied,
            'referral_source' => $request->referral_source,
            'available_start_date' => $request->available_start_date,
            'expected_salary' => $request->expected_salary,
            'notice_period' => $request->notice_period,
            'textile_experience' => $request->textile_experience === 'yes',
            'status' => 'pending',
        ];

        // Handle file uploads
        if ($request->hasFile('sss_file')) {
            $applicantData['sss_file_path'] = $request->file('sss_file')->store('applicants/documents', 'public');
        }

        if ($request->hasFile('philhealth_file')) {
            $applicantData['philhealth_file_path'] = $request->file('philhealth_file')->store('applicants/documents', 'public');
        }

        if ($request->hasFile('pagibig_file')) {
            $applicantData['pagibig_file_path'] = $request->file('pagibig_file')->store('applicants/documents', 'public');
        }

        $applicant = Applicant::create($applicantData);

        return response()->json([
            'success' => true,
            'message' => 'Applicant saved successfully!',
            'applicant' => $applicant,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,under_review,interview_scheduled,interview_passed,interview_failed,accepted,rejected',
            'interview_date' => 'nullable|date|required_if:status,interview_scheduled',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $applicant->update([
            'status' => $request->status,
            'interview_date' => $request->interview_date,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);

        // Delete uploaded files
        if ($applicant->sss_file_path) {
            Storage::disk('public')->delete($applicant->sss_file_path);
        }
        if ($applicant->philhealth_file_path) {
            Storage::disk('public')->delete($applicant->philhealth_file_path);
        }
        if ($applicant->pagibig_file_path) {
            Storage::disk('public')->delete($applicant->pagibig_file_path);
        }

        $applicant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Applicant deleted successfully!',
        ]);
    }

    /**
     * Get application statistics
     */
    public function getStatistics()
    {
        $stats = [
            'total' => Applicant::count(),
            'pending' => Applicant::where('status', 'pending')->count(),
            'interview_scheduled' => Applicant::where('status', 'interview_scheduled')->count(),
            'rejected' => Applicant::where('status', 'rejected')->count(),
            'accepted' => Applicant::where('status', 'accepted')->count(),
            'under_review' => Applicant::where('status', 'under_review')->count(),
            'interview_passed' => Applicant::where('status', 'interview_passed')->count(),
            'interview_failed' => Applicant::where('status', 'interview_failed')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Schedule interview
     */
    public function scheduleInterview(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'interview_date' => 'required|date|after:now',
            'interview_type' => 'required|in:phone,video,in_person',
            'duration' => 'nullable|integer|min:15|max:240',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $applicant = Applicant::findOrFail($id);

        // Update applicant status
        $applicant->update([
            'status' => 'interview_scheduled',
            'interview_date' => $request->interview_date,
        ]);

        // Create interview schedule record
        InterviewSchedule::create([
            'applicant_id' => $applicant->id,
            'scheduled_date' => $request->interview_date,
            'interview_type' => $request->interview_type,
            'duration' => $request->duration,
            'location' => $request->location,
            'notes' => $request->notes,
            'status' => 'scheduled',
            'interviewer_id' => auth()->id(), // Set current user as interviewer
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Interview scheduled successfully!',
        ]);
    }

    /**
     * Update status
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,under_review,interview_scheduled,interview_passed,interview_failed,accepted,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $applicant = Applicant::findOrFail($id);
        $applicant->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
        ]);
    }

    /**
     * Get interview schedules for an applicant
     */
    public function getInterviewSchedules($id)
    {
        $applicant = Applicant::findOrFail($id);
        $interviews = InterviewSchedule::where('applicant_id', $id)
            ->orderBy('scheduled_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'interviews' => $interviews,
        ]);
    }
}

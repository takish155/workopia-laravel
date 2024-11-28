<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewApplicantController extends Controller
{
    // @desc Store new job application
    // @route POST /jobs/{job}/apply
    public function store(Request $req, Job $job): RedirectResponse
    {
        // Check if user has already applied
        $existingApplication = Applicant::where("job_id", $job->id)
            ->where("user_id", auth()->id())
            ->exists();
        if ($existingApplication) {
            return redirect()->back()->with("error", "You have already applied to this job");
        }

        // Validate incoming data
        $validatedData = $req->validate([
            "full_name" => "required|string",
            "contact_phone" => "string",
            "contact_email" => "required|string|email",
            "message" => "string",
            "location" => "string",
            "resume" => "required|file|mimes:pdf|max:2048"
        ]);

        // Handle resume upload
        $path =  $req->file("resume")->store("resumes", "public");
        $validatedData["resume_path"] = $path;


        // Store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = Auth::user()->id;
        $application->save();

        return redirect()->back()->with("success", "Your application has been submitted");
    }

    // @desc Delete applicant
    // @route DELETE /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();

        return redirect()->route("dashboard.index")->with("success", "Application has been removed");
    }
}

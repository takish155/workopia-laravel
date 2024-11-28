<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    // @desc Display all jobs available
    // @route GET /jobs
    public function index(): View
    {
        $title = "Hello Jobs!";
        $jobs = Job::latest()->paginate(6);

        return view("jobs.index", compact("jobs", "title"));
    }

    // @desc Show form for creating job listing
    // @route GET /jobs/create
    public function create(): View
    {
        //
        return view("jobs.create");
    }

    // @desc Save job to database 
    // @route POST /jobs
    public function store(Request $req): RedirectResponse
    {
        //

        $validatedData = $req->validate([
            "title" => "required|string|max:255|min:3",
            "description" => "required|string",
            "salary" => "required|integer",
            "tags" => "nullable|string", // Changed from nullable|required to nullable|string
            "job_type" => "required|string",
            "remote" => "required|in:true,false",
            "requirements" => "nullable|string",
            "benefits" => "nullable|string",
            "address" => "nullable|string", // Fixed typo
            "city" => "required|string",
            "state" => "required|string",
            "zipcode" => "nullable|string",
            "contact_email" => "required|email", // Added email validation
            "contact_phone" => "nullable|string",
            "company_name" => "required|string",
            "company_description" => "nullable|string",
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048", // Corrected image validation
            "company_website" => "nullable|url"
        ]);

        $validatedData['remote'] = filter_var($validatedData['remote'], FILTER_VALIDATE_BOOLEAN);

        // Hardcoded user id
        $validatedData["user_id"] = Auth::user()->id;

        // Check for images
        if ($req->hasFile("company_logo")) {
            // Store the files (public/logos)
            $path = $req->file("company_logo")->store("logos", "public");

            // Add path to validated data
            $validatedData["company_logo"] = $path;
        }

        Job::create($validatedData);


        return redirect("/jobs")->with("success", "Job listing created successfully!");
    }

    // @desc Show data about the specified jobb listing
    // @route GET /jobs/{id} 
    public function show(Job $job)
    {
        //
        return view("jobs.show")->with("job", $job);
    }

    // @desc Show form for updating a job listing
    // @route POST /jobs{id}/edit
    public function edit(Job $job)
    {
        // Check if user is authorized
        $this->authorize("update", $job);

        return view("jobs.edit")->with("job", $job);
    }

    // @desc Update the job listing 
    // @route PUT /jobs/{id}
    public function update(Request $req, Job $job)
    {
        // Check if user is authorized
        $this->authorize("update", $job);

        $validatedData = $req->validate([
            "title" => "required|string|max:255|min:3",
            "description" => "required|string",
            "salary" => "required|integer",
            "tags" => "nullable|string", // Changed from nullable|required to nullable|string
            "job_type" => "required|string",
            "remote" => "required|in:true,false",
            "requirements" => "nullable|string",
            "benefits" => "nullable|string",
            "address" => "nullable|string", // Fixed typo
            "city" => "required|string",
            "state" => "required|string",
            "zipcode" => "nullable|string",
            "contact_email" => "required|email", // Added email validation
            "contact_phone" => "nullable|string",
            "company_name" => "required|string",
            "company_description" => "nullable|string",
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048", // Corrected image validation
            "company_website" => "nullable|url"
        ]);

        $validatedData['remote'] = filter_var($validatedData['remote'], FILTER_VALIDATE_BOOLEAN);

        // Check for images
        if ($req->hasFile("company_logo")) {
            // Delete old logo
            if ($job->company_logo) {
                Storage::delete("public/logos" . basename($job->company_logo));
            }

            // Store the files (public/logos)
            $path = $req->file("company_logo")->store("logos", "public");

            // Add path to validated data
            $validatedData["company_logo"] = $path;
        }

        $job->update($validatedData);


        return redirect("/jobs")->with("success", "Job listing updated successfully!");
    }

    // @desc Remove the job listing from the database
    // @route DELETE /jobs/{id}
    public function destroy(Job $job): RedirectResponse
    {
        // Check if user is authorized
        $this->authorize("update", $job);

        if ($job->company_logo) {
            Storage::delete("public/logos/" . $job->company_logo);
        }

        $job->delete();

        if (request()->query("from") === "dashboard") {
            return redirect("/dashboard")->with("success", "Job listing deleted successfully!");
        }

        return redirect("/jobs")->with("success", "Job listing deleted successfully!");
    }
}

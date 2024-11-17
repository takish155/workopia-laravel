<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $title = "Hello Jobs!";
        $jobs = Job::all();

        return view("jobs.index", compact("jobs", "title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view("jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req): RedirectResponse
    {
        //
        $validatedData = $req->validate([
            "title" => "required|string|max:255|min:3",
            "description" => "required|string",
        ]);

        $job = Job::create(["title" => $validatedData["title"], "description" => $validatedData["description"]]);

        return redirect("/jobs");
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
        return view("jobs.show")->with("job", $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(): View
    {
        $jobs = Job::latest()->limit(6)->get();

        return view("pages.index", compact("jobs"));
    }
}

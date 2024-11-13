<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get("/jobs", function () {
    $title = "Hello Listing!";
    $jobs = ["Web Developers", "System Engineers", "Back-End Developers"];
    // return view("jobs.index", [
    //     "title" => $title
    // ]);

    // return view("jobs.index")->with("title", $title);

    return view("jobs.index", compact("title", "jobs"));
})->name("jobs");

Route::get("/jobs/create", function () {
    return view("jobs.create"); // "views/create.php"
});

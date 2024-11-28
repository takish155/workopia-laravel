<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewApplicantController;

use App\Http\Middleware\LogRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, "index"])->name("home");

Route::resource("jobs", JobController::class)->only(["index", "show"]);

Route::middleware("auth")->group(function () {
  Route::resource("jobs", JobController::class)->except(["index", "show"]);
  Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");

  Route::get("/bookmarks", [BookmarkController::class, "index"]);
  Route::post("/bookmarks/{job}", [BookmarkController::class, "store"])->name("bookmarks.store");
  Route::delete("/bookmarls/{job}", [BookmarkController::class, "destroy"])->name("bookmarks.destroy");

  Route::post("/jobs/{job}/apply", [NewApplicantController::class, "store"])->name("applicant.store");
  Route::delete("/applicants/{applicant}", [NewApplicantController::class, "destroy"])->name("applicant.destroy");


  Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
});

Route::middleware("guest")->group(function () {
  Route::get("/register", [RegisterController::class, "register"])->name("register")->middleware(LogRequest::class);
  Route::post("/register", [RegisterController::class, "store"])->name("register.store");

  Route::get("/login", [LoginController::class, "login"])->name("login")->middleware(LogRequest::class);
  Route::post("/login", [LoginController::class, "authenticate"])->name("login.authenticate");
});


Route::post("/logout", [LoginController::class, "destroy"])->name("logout");

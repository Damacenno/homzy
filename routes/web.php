<?php

use App\Http\Controllers\JobController;
use App\Models\CleaningJob;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    $OfferJobs = JobController::getHomePageJobsOffers();
    if (auth()->check()) {
        $userJobs = JobController::getLoggedUserScheduledJobs();
        return view('home', compact('OfferJobs', 'userJobs'));
    } else {
        return view('home', compact('OfferJobs'));
    }
})->name('home');

Route::get('/login-page', function () {
    return view('login-page');
})->name('user.login');

Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/jobdetails/{id}', function ($id) {
    $job = CleaningJob::with([
        'property.owner',
        'status',
        'applications.cleaner'
    ])->findOrFail($id);

    return view('job-details', compact('job'));
})->name('job.details');

Route::get('/findcleaners', [UserController::class, 'findCleaners'])->name('find.cleaners');

Route::get('/cleanerdetails/{id}', [UserController::class, 'getCleanerDetails'])->name('cleaner.details');

Route::post('/applyjob/{id}', [JobController::class, 'applyForJob'])->name('job.apply');


Route::get('/homologacao', function () {
    return view('homolog');
});
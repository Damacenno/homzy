<?php

use App\Http\Controllers\JobController;
use App\Models\CleaningJob;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $OfferJobs = JobController::getHomePageJobsOffers($request->get('filter'));
    
    if (auth()->check()) {
        $userJobs = JobController::getLoggedUserScheduledJobs();
        $stats = JobController::getLoggedUserStats();
        
        return view('home', compact('OfferJobs', 'userJobs', 'stats'));
    }
    
    return view('home', compact('OfferJobs'));
})->name('home');

Route::get('/login-page', function () {
    return view('login-page');
})->name('user.login');

Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/jobdetails/{id}', [JobController::class, 'getJobDetails'])->name('job.details');

Route::get('/findcleaners', [UserController::class, 'findCleaners'])->name('find.cleaners');
Route::get('/cleanerdetails/{id}', [UserController::class, 'getCleanerDetails'])->name('cleaner.details');
Route::post('/applyjob/{id}', [JobController::class, 'applyForJob'])->name('job.apply');
Route::post('/accept-application/{id}', [JobController::class, 'acceptApplication'])->name('application.accept');
Route::post('/reject-application/{id}', [JobController::class, 'rejectApplication'])->name('application.reject');

Route::get('/job/create', [JobController::class, 'create'])->name('job.create')->middleware('auth');
Route::post('/job/store', [JobController::class, 'store'])->name('job.store')->middleware('auth');

Route::get('/homologacao', function () {
    return view('homolog');
});
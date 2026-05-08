<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

use App\Models\CleaningJob;
use Exception;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public static function getHomePageJobsOffers()
    {
        return CleaningJob::with(['property', 'status'])
            ->whereHas('status', function ($query) {
                $query->where('key', 'PENDING');
            })
            ->get();
    }

    public static function getLoggedUserScheduledJobs()
    {
        return CleaningJob::with('property')
            ->where('cleaner_user_id', auth()->id())
            ->get();
    }

    public function applyForJob(Request $request, $id)
    {
        try {
            $message = $request->input('message');

            JobApplication::create([
                'application_type' => 'cleaner',
                'job_id' => $id,
                'cleaner_id' => Auth::id(),
                'status' => 0,
                'message' => $message
            ]);

            return redirect()->back()->with('success', 'Candidatura enviada!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao aplicar: ' . $e->getMessage());
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Models\CleaningJob;
use App\Models\Property;
use Exception;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $OfferJobs = self::getHomePageJobsOffers($request->get('filter'));

        if (!auth()->check()) {
            return view('home', compact('OfferJobs'));
        }

        $userJobs = self::getLoggedUserScheduledJobs();
        $stats = self::getLoggedUserStats();

        switch (auth()->user()->userType->key) {

            case 'PROPERTY_OWNER':
                // Retorna a view específica do proprietário dentro de subpastas
                return view('property-owners.home', compact('OfferJobs', 'userJobs', 'stats'));

            case 'PROFESSIONAL_CLEANER':
            case 'ADMIN_ACCOUNT':
            default:
                // Retorna a view padrão da home (Profissional / Geral)
                return view('home', compact('OfferJobs', 'userJobs', 'stats'));
        }
    }

    public static function getHomePageJobsOffers($filter = null)
    {
        $query = CleaningJob::with(['property', 'status'])
            ->whereHas('status', function ($query) {
                $query->where('key', 'PENDING');
            });

        if ($filter === 'best_rating') {
            $query->join('properties', 'cleaning_jobs.property_id', '=', 'properties.id')
                ->orderBy('properties.rating', 'desc')
                ->select('cleaning_jobs.*');
        } elseif ($filter === 'newest') {
            $query->latest();
        }

        return $query->get();
    }

    public function getJobDetails($id)
    {
        switch (auth()->user()->userType->key) {
            case 'PROPERTY_OWNER':
                $job = CleaningJob::with([
                    'property.owner',
                    'status',
                    'applications.cleaner'
                ])->findOrFail($id);

                $rejectedCleaner = JobApplication::where('job_id', $id)
                    ->where('status', 'REJECTED')
                    ->where('cleaner_id', auth()->id());


                if ($rejectedCleaner->exists()) {
                    $job->UserApplicationRejected = true;
                    // dd($rejectedCleaner, $job->UserApplicationRejected);
                }
                return view('property-owners.job-manage', compact('job'));
                break;
            case 'PROFESSIONAL_CLEANER':
                $job = CleaningJob::with([
                    'property.owner',
                    'status'
                ])->findOrFail($id);
                return view('job-details', compact('job'));
                break;
            default:
                // fallback sei la af sksksks '-'
                break;
        }
    }

    public static function getLoggedUserScheduledJobs()
    {
        return CleaningJob::with(['property', 'status'])
            ->where('cleaner_user_id', auth()->id())
            ->get();
    }

    public static function getLoggedUserStats()
    {
        $userId = auth()->id();

        return [
            'total_completed' => CleaningJob::where('cleaner_user_id', $userId)
                ->whereHas('status', function ($q) {
                    $q->where('key', 'COMPLETED');
                })->count(),

            'total_scheduled' => CleaningJob::where('cleaner_user_id', $userId)->count(),
        ];
    }

    public function applyForJob(Request $request, $id)
    {
        try {
            $message = $request->input('message');

            JobApplication::create([
                'application_type' => 'cleaner',
                'job_id' => $id,
                'cleaner_id' => Auth::id(),
                'status' => 'PENDING',
                'message' => $message
            ]);

            return redirect()->back()->with('success', 'Candidatura enviada!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao aplicar: ' . $e->getMessage());
        }
    }

    public function acceptApplication($id)
    {
        try {
            $application = JobApplication::findOrFail($id);
            $application->status = 'ACCEPTED';
            $application->save();

            $job = CleaningJob::findOrFail($application->job_id);
            $job->cleaner_user_id = $application->cleaner_id;
            $job->status_id = 2;
            $job->save();

            return redirect()->back()->with('success', 'Candidatura aceita!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao aceitar candidatura: ' . $e->getMessage());
        }
    }

    public function rejectApplication($id)
    {
        try {
            $application = JobApplication::findOrFail($id);
            $application->status = 'REJECTED';
            $application->save();

            return redirect()->back()->with('success', 'Candidatura rejeitada!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao rejeitar candidatura: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $properties = Property::where('owner_user_id', auth()->id())->get();
        return view('job-create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
        ]);

        try {
            CleaningJob::create([
                'property_id' => $request->property_id,
                'status_id' => 1,
                'cleaner_user_id' => null,
            ]);

            return redirect()->route('home')->with('success', 'Faxina solicitada com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar serviço: ' . $e->getMessage());
        }
    }
}
@extends('layout')

@section('content')
    @if (Auth::check())

        @if (isset($userJobs))
            <h2>Your Scheduled Jobs</h2>
            <div class="flex">
                @foreach ($userJobs as $job)
                    <a href="{{ route('job.details', ['id' => $job->id]) }}">
                        <div class="border-2 border-gray-300 rounded-lg p-4 m-2">
                            <h3>{{ $job->property->name }}</h3>
                            <p>{{ $job->status->name }}</p>
                            <b>{{ $job->property->rating }}</b>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    @else
        <h1>Seu serviços aparecerão aqui</h1>
        <a href="{{ route('user.login') }}"
            class="px-4 border-2 border-black font-bold hover:bg-black hover:text-white transition-colors">
            Entrar agora
        </a>
    @endif

    @if (isset($OfferJobs))
        <h2>Enqt Isto</h2>
        <div class="flex gap-8">
            @foreach ($OfferJobs as $job)
                <a href="{{ route('job.details', ['id' => $job->id]) }}">
                    <div class="bg-white border-4 border-black p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <h3>{{ $job->property->name }}</h3>
                        <p>{{ $job->status->name }}</p>
                        <b>{{ $job->property->rating }}</b>
                    </div>
                </a>
            @endforeach
        </div>
    @endif


@endsection
@extends('layout')

@section('content')
    <div class="space-y-12 my-6">
        <h2 class="text-2xl font-black uppercase tracking-tight bg-[#facc15] border-4 border-black px-4 py-2 inline-block shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
            Painel do Proprietário
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-black uppercase mb-2">📅 Solicitar Novo Serviço</h3>
                    <p class="text-sm font-bold text-gray-600 mb-6">Cadastre o serviço e receba propostas de profissionais.</p>
                </div>
                <a href="{{ route('job.create') }}" class="inline-block border-4 border-black px-4 py-3 bg-lime-400 font-black uppercase text-sm shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-x-0 active:translate-y-0 active:shadow-none transition-all self-start">
                    + Solicitar Faxina
                </a>
            </div>

            <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black uppercase mb-2">📊 Suas Estatísticas</h3>
                <div class="grid grid-cols-2 gap-4 border-t-4 border-black pt-4">
                    <div class="bg-gray-50 border-2 border-black p-3 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                        <span class="text-[10px] font-black uppercase text-gray-500 block">Limpezas Contratadas</span>
                        <span class="text-3xl font-black">{{ $stats['total_scheduled'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            @foreach ($OwnercleaningJobs as $job)
                <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="text-lg font-bold uppercase mb-2">{{ $job->property->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">Status: {{ $job->status->name }}</p>
                    <a href="{{ route('job.details', $job->id) }}" class="inline-block border-4 border-black px-4 py-2 bg-lime-400 font-bold uppercase text-sm shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-x-0 active:translate-y-0 active:shadow-none transition-all">
                        Ver Detalhes
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
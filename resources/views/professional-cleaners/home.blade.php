@extends('layout')

@section('content')
    <div class="space-y-12 my-6">

        @if (Auth::check())
            @if (isset($userJobs) && count($userJobs) > 0)
                <div>
                    <div class="">
                        <h2
                            class="text-2xl font-black uppercase tracking-tight inline-block bg-[#facc15] border-4 border-black px-4 py-2 mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                            Seus Agendamentos
                        </h2>
                         <h2
                            class="md:ml-4 text-sm font-black uppercase tracking-tight inline-block bg-[#facc15] border-4 border-black px-4 py-2 mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                            Meu calendário
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($userJobs as $job)
                            <a href="{{ route('job.details', ['id' => $job->id]) }}"
                                class="block group active:translate-x-[4px] active:translate-y-[4px] active:shadow-none bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-black uppercase tracking-tight group-hover:underline">
                                        {{ $job->property->name }}</h3>
                                    <span class="bg-black text-white text-xs font-black px-2 py-1 uppercase">
                                        ⭐ {{ $job->property->rating }}
                                    </span>
                                </div>
                                <p
                                    class="text-sm font-bold uppercase inline-block bg-cyan-200 border-2 border-black px-2 py-0.5">
                                    {{ $job->status->name }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-center my-6">
                    <h1 class="text-3xl font-black uppercase tracking-tight mb-4">Nenhum agendamento encontrado</h1>
                    <p class="font-bold text-gray-700">Você ainda não possui serviços contratados ou agendados.</p>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] @if ( Auth::user()->user_type_id == 2 ) hidden @endif" >
                    <h3 class="text-xl font-black uppercase mb-2">📅 Solicitar Novo Serviço</h3>
                    <p class="text-sm font-bold text-gray-700 mb-6">Precisa de uma limpeza imediata em seu imóvel? Cadastre
                        o serviço e receba propostas de profissionais.</p>
                    <a href="{{ route('job.create') }}"
                        class="inline-block text-center border-2 border-black px-4 py-2 bg-lime-400 font-black uppercase text-sm shadow-[4px_4px_0_0_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                        + Solicitar Faxina
                    </a>
                </div>

                <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]@if ( Auth::user()->user_type_id == 2 ) col-span-1 md:col-span-2 @endif">
                    <h3 class="text-xl font-black uppercase mb-2">📊 Seu Painel Geral</h3>
                    <p class="text-sm font-bold text-gray-700 mb-4">Acompanhamento resumido das suas atividades históricas e
                        ativas na plataforma.</p>

                    <div class="grid grid-cols-2 gap-4 border-t-4 border-black pt-4">
                        <div>
                            <span class="text-xs font-black uppercase text-gray-500 block">Limpezas Concluídas</span>
                            <span class="text-2xl font-black">{{ Auth::check() ? $stats['total_completed'] : '0' }}</span>
                        </div>
                        <div>
                            <span class="text-xs font-black uppercase text-gray-500 block">Total Agendado</span>
                            <span
                                class="text-2xl font-black text-blue-600">{{ Auth::check() ? $stats['total_scheduled'] : '0' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-center my-6">
                <h1 class="text-3xl font-black uppercase tracking-tight mb-6">Seus serviços aparecerão aqui</h1>
                <a href="{{ route('user.login') }}"
                    class="inline-block px-6 py-3 border-4 border-black font-black uppercase bg-[#facc15] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
                    Entrar agora
                </a>
            </div>
        @endif

        <div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <h2
                    class="text-2xl font-black uppercase tracking-tight inline-block bg-purple-400 text-white border-4 border-black px-4 py-2 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                    Ofertas Disponíveis
                </h2>

                <div class="flex gap-2 items-center">
                    <span class="font-black uppercase text-xs">Filtrar por:</span>
                    <a href="{{ route('home') }}"
                        class="border-2 border-black px-3 py-1 font-bold text-xs bg-white {{ !request('filter') ? 'bg-black text-white' : '' }}">
                        Todos
                    </a>
                    <a href="{{ route('home', ['filter' => 'best_rating']) }}"
                        class="border-2 border-black px-3 py-1 font-bold text-xs bg-white {{ request('filter') === 'best_rating' ? 'bg-[#facc15]' : '' }}">
                        ⭐ Melhor Nota
                    </a>
                    <a href="{{ route('home', ['filter' => 'newest']) }}"
                        class="border-2 border-black px-3 py-1 font-bold text-xs bg-white {{ request('filter') === 'newest' ? 'bg-cyan-200' : '' }}">
                        📅 Recentes
                    </a>
                </div>
            </div>

            @if (isset($OfferJobs) && count($OfferJobs) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($OfferJobs as $job)
                        <a href="{{ route('job.details', ['id' => $job->id]) }}"
                            class="block group active:translate-x-[4px] active:translate-y-[4px] active:shadow-none bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-black uppercase tracking-tight group-hover:underline">
                                    {{ $job->property->name }}</h3>
                                <span class="bg-[#facc15] border-2 border-black font-black px-2 py-0.5 text-xs">
                                    ⭐ {{ $job->property->rating }}
                                </span>
                            </div>
                            <p
                                class="text-sm font-bold uppercase inline-block bg-lime-300 border-2 border-black px-2 py-0.5">
                                {{ $job->status->name }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white border-4 border-black p-6 text-center shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                    <p class="font-bold uppercase text-gray-600">Nenhuma oferta encontrada para este critério.</p>
                </div>
            @endif
        </div>

        <hr class="border-2 border-black my-12" />



    </div>
@endsection

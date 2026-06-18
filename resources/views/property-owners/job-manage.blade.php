@extends('layout')

@section('content')
    <style>
        @keyframes slideToggleBrutal {
            0% {
                transform: translateX(0);
                box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 1);
            }

            50% {
                box-shadow: 1px 1px 0px 0px rgba(0, 0, 0, 1);
            }

            100% {
                transform: translateX(28px);
                box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 1);
            }
        }

        .toggle-brutal-slide {
            animation: slideToggleBrutal 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        input:checked~div .toggle-square {
            animation: slideToggleBrutal 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
    </style>
    <script>

        function toggleEditMode() {
            const forms = document.querySelectorAll('.taskForm-required');
            forms.forEach(form => form.classList.toggle('hidden'));
        }

        function toggleApplicationsFilter() {
            const receivedApplicationsTitle = document.getElementById('receivedApplicationsTitle');
            const rejectedApplicationsTitle = document.getElementById('rejectedApplicationsTitle');
            const receivedApplicationsList = document.getElementById('receivedApplicationsList');
            const rejectedApplicationsList = document.getElementById('rejectedApplicationsList');

            receivedApplicationsTitle.classList.toggle('hidden');
            rejectedApplicationsTitle.classList.toggle('hidden');
            receivedApplicationsList.classList.toggle('hidden');
            rejectedApplicationsList.classList.toggle('hidden');
        }

    </script>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex items-end gap-4">
            <h1
                class="text-4xl font-black uppercase italic bg-black text-white inline-block px-4 py-2 shadow-[4px_4px_0px_0px_rgba(250,204,21,1)]">
                GERENCIAR
            </h1>
            <h1
                class="text-xl font-black uppercase italic bg-black text-white inline-block px-4 py-2 shadow-[4px_4px_0px_0px_rgba(250,204,21,1)]">
                {{ $job->property->name }}
            </h1>
        </div>

        <span
            class="bg-blue-400 border-4 border-black px-4 py-2 font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] self-start sm:self-auto">
            Status: {{ $job->status->name ?? 'Aberto' }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 flex flex-col gap-6">

            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div
                    class="border-4 border-black flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-4 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

                    <div class="flex-1 min-w-0">
                        <h2 id="receivedApplicationsTitle"
                            class="text-2xl font-black uppercase underline decoration-yellow-400 tracking-wide break-words">
                            Candidaturas Recebidas ({{ $job->applications->where('status', 'PENDING')->count() }})
                        </h2>

                        <h2 id="rejectedApplicationsTitle"
                            class="hidden text-2xl font-black uppercase underline decoration-yellow-400 tracking-wide break-words">
                            Candidaturas Rejeitadas ({{ $job->applications->where('status', 'REJECTED')->count() }})
                        </h2>
                    </div>

                    <div class="flex items-center shrink-0 ml-auto">
                        <label class="inline-flex items-center cursor-pointer select-none gap-3">
                            <input type="checkbox" class="sr-only peer" onclick="toggleApplicationsFilter()" />
                            <div
                                class="w-16 h-9 bg-[#A3E635] rounded-none border-4 border-black 
                                                                        shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] 
                                                                        peer-checked:bg-[#F43F5E] 
                                                                        transition-colors duration-200 
                                                                        relative flex items-center px-1
                                                                        active:translate-x-[2px] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">

                                <div class="toggle-square w-5 h-5 bg-white border-2 border-black rounded-none
                                                                            shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="space-y-6 mt-6">
                    <div id="receivedApplicationsList" class="space-y-6">
                        @forelse ($job->applications->where('status', 'PENDING') as $application)
                            <div class="border-4 border-black bg-gray-50 p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative">

                                <div
                                    class="absolute -right-2 -top-2 border-2 border-black px-2 py-0.5 text-[10px] font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]
                                                                                                    {{ $application->status === 'PENDING' ? 'bg-yellow-400' : ($application->status === 'ACCEPTED' ? 'bg-green-400 text-black' : 'bg-red-500 text-white') }}">
                                    {{ $application->status === 'PENDING' ? 'Pendente' : ($application->status === 'ACCEPTED' ? 'Aceito' : 'Recusado') }}
                                </div>

                                <div class="flex justify-between items-start mb-3 mt-1">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 border-4 border-black bg-purple-400 flex items-center justify-center font-black text-white text-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                            {{ substr($application->cleaner->name ?? 'C', 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-black uppercase text-lg leading-tight">
                                                {{ $application->cleaner->name ?? 'Candidato Desconhecido' }}
                                            </h4>
                                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                                Nota do profissional: ⭐ {{ $application->cleaner->rating ?? '5.0' }}
                                            </p>
                                        </div>
                                        @if("$application->status" == 'PENDING')
                                            <div class="absolute right-10 flex items-center gap-4">
                                                <form action="/accept-application/{{ $application->id }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="flex items-center justify-center w-12 h-10 bg-green-400 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] 
                                                                                   hover:bg-green-300
                                                                                   active:translate-x-[2px] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] 
                                                                                   transition-all cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="3" stroke="currentColor" class="w-6 h-6 text-black">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <form action="/reject-application/{{ $application->id }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="flex items-center justify-center w-12 h-10 bg-red-500 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] 
                                                        hover:bg-green-300
                                                        active:translate-x-[2px] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] 
                                                        transition-all cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="3" stroke="currentColor" class="w-6 h-6 text-black">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18 18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div
                                    class="bg-white border-2 border-black p-3 mb-4 shadow-[inset_2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    <p class="text-xs font-bold italic text-gray-700">
                                        "{{ $application->message ?? 'O candidato não enviou uma mensagem.' }}"
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="border-4 border-dashed border-black p-8 text-center bg-gray-50">
                                <p class="font-black uppercase text-gray-400 italic">Nenhuma candidatura recebida para este
                                    anúncio.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <div id="rejectedApplicationsList" class="hidden space-y-6">
                        @forelse ($job->applications->where('status', 'REJECTED') as $application)
                            <div class="border-4 border-black bg-gray-50 p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative">

                                <div
                                    class="absolute -right-2 -top-2 border-2 border-black px-2 py-0.5 text-[10px] font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]
                                                                                                    {{ $application->status === 'PENDING' ? 'bg-yellow-400' : ($application->status === 'ACCEPTED' ? 'bg-green-400 text-black' : 'bg-red-500 text-white') }}">
                                    {{ $application->status === 'PENDING' ? 'Pendente' : ($application->status === 'ACCEPTED' ? 'Aceito' : 'Recusado') }}
                                </div>

                                <div class="flex justify-between items-start mb-3 mt-1">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 border-4 border-black bg-purple-400 flex items-center justify-center font-black text-white text-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                            {{ substr($application->cleaner->name ?? 'C', 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-black uppercase text-lg leading-tight">
                                                {{ $application->cleaner->name ?? 'Candidato Desconhecido' }}
                                            </h4>
                                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                                Nota do profissional: ⭐ {{ $application->cleaner->rating ?? '5.0' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-white border-2 border-black p-3 mb-4 shadow-[inset_2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    <p class="text-xs font-bold italic text-gray-700">
                                        "{{ $application->message ?? 'O candidato não enviou uma mensagem.' }}"
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="border-4 border-dashed border-black p-8 text-center bg-gray-50">
                                <p class="font-black uppercase text-gray-400 italic">Nenhuma candidatura rejeitada para este
                                    anúncio.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-xl font-black uppercase mb-2 underline decoration-blue-400">O que você colocou no anúncio:
                </h2>
                <p class="font-bold text-gray-700 text-sm leading-relaxed">
                    {{ $job->property->description ?? 'Nenhuma descrição detalhada fornecida.' }}
                </p>
            </div>
            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex items-center justify-between mb-6 border-b-4 border-black pb-4">
                    <h2
                        class="text-2xl font-black uppercase tracking-tight bg-[#facc15] border-4 border-black px-4 py-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                        📋 Checklist de Tarefas
                    </h2>
                    <span class="text-xs font-black uppercase bg-black text-white px-2 py-1">
                        Total: {{ is_array($job->tasks) ? count($job->tasks) : 0 }}
                    </span>
                    <button class="border-4 border-black bg-white p-6" onclick="toggleEditMode()">
                        <span>Editar</span>
                    </button>
                </div>

                <div class="space-y-4">
                    @if (!empty($job->tasks) && is_array($job->tasks))
                        @foreach ($job->tasks as $index => $task)
                            <div
                                class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 border-4 border-black bg-gray-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all">

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-6 h-6 border-4 border-black flex-shrink-0 bg-white flex items-center justify-center mt-0.5">
                                        @if (data_get($task, 'is_required'))
                                            <div class="w-3 h-3 bg-red-500 border border-black"></div>
                                        @else
                                            <div class="w-3 h-3 bg-gray-300 border border-black"></div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <span class="font-black text-sm uppercase tracking-tight text-black">
                                            {{ data_get($task, 'task') }}
                                        </span>

                                        <div class="flex flex-wrap gap-2 items-center">
                                            @if (data_get($task, 'is_required'))
                                                <span
                                                    class="text-[9px] font-black uppercase bg-red-200 text-red-700 border-2 border-black px-1.5 py-0.5 shadow-[1px_1px_0_0_rgba(0,0,0,1)]">
                                                    🚨 Obrigatório
                                                </span>
                                            @else
                                                <span
                                                    class="text-[9px] font-black uppercase bg-gray-200 text-gray-600 border-2 border-black px-1.5 py-0.5">
                                                    Opcional
                                                </span>
                                            @endif

                                            @php
                                                $importance = data_get($task, 'importance_level', 5);
                                                $badgeColor = 'bg-green-300';
                                                if ($importance > 7) {
                                                    $badgeColor = 'bg-red-400';
                                                } elseif ($importance > 4) {
                                                    $badgeColor = 'bg-amber-300';
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </div>

                                <form action="" method="POST"
                                    class="taskForm-required hidden flex items-center gap-2 border-2 md:border-4 border-black bg-white p-2 shadow-[2px_2px_0_0_rgba(0,0,0,1)] self-start md:self-auto">
                                    @csrf
                                    <label class="text-[10px] font-black uppercase tracking-tight text-gray-700 whitespace-nowrap">
                                        Obrigatório?
                                    </label>
                                    <select name="tasks[{{ $index }}][is_required]" onchange="this.form.submit()"
                                        class="bg-white text-xs font-black uppercase border-2 border-black px-2 py-1 cursor-pointer focus:outline-none focus:bg-yellow-100">
                                        <option value="1" {{ data_get($task, 'is_required') ? 'selected' : '' }}>Sim</option>
                                        <option value="0" {{ !data_get($task, 'is_required') ? 'selected' : '' }}>Não</option>
                                    </select>
                                </form>

                            </div>
                        @endforeach
                    @else
                        <div
                            class="border-4 border-dashed border-black p-8 text-center bg-gray-50 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                            <p class="font-black uppercase text-gray-400 text-sm tracking-wider">
                                📭 Nenhuma tarefa cadastrada para este serviço
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6 h-full">

            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-xl font-black uppercase mb-4 border-b-4 border-black pb-2 inline-block">
                    Resumo do Contrato
                </h2>

                <div class="space-y-4">
                    <div
                        class="bg-white border-2 border-black p-3 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
                        <p class="text-[10px] font-black uppercase text-gray-500">Valor que você Ofertou</p>
                        <p class="text-xl font-black text-green-600">R$ {{ number_format($job->price, 2, ',', '.') }}</p>
                    </div>

                    <div
                        class="bg-white border-2 border-black p-3 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex flex-col gap-1">
                        <div class="flex justify-between items-center">
                            <p class="text-[10px] font-black uppercase text-gray-500">Data Agendada</p>
                            <p class="text-xs font-black">{{ \Carbon\Carbon::parse($job->scheduled_date)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="border-t border-black my-1 border-dashed"></div>
                        <div class="flex justify-between items-center">
                            <p class="text-[10px] font-black uppercase text-gray-500">Limite de Chegada</p>
                            <p class="text-xs font-black">
                                {{ \Carbon\Carbon::parse($job->scheduled_arrival_time_minimum)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-4 border-black bg-red-50 p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="font-black uppercase text-sm text-red-600 mb-2">Painel de Controle</h3>
                <button
                    onclick="if(confirm('Tem certeza que deseja cancelar este anúncio de serviço?')) window.location.href='/cancel-job/{{ $job->id }}'"
                    class="w-full py-3 bg-red-500 text-white border-4 border-black font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all cursor-pointer">
                    Cancelar Oferta de Vaga
                </button>
            </div>

        </div>
    </div>
@endsection
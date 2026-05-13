@extends('layout')

@section('content')
    <div class="mb-6 flex items-end gap-4">

        <h1
            class="text-4xl font-black uppercase italic bg-black text-white inline-block px-4 py-2 shadow-[4px_4px_0px_0px_rgba(250,204,21,1)]">
            DETALHES
        </h1>

        <h1
            class="text-xl font-black uppercase italic bg-black text-white inline-block px-4 py-2 shadow-[4px_4px_0px_0px_rgba(250,204,21,1)]">
            {{ $job->property->name }}
        </h1>


    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!--Fotos e Descrição -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div class="border-4 border-black bg-white p-4 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div
                    class="relative grid grid-cols-4 grid-rows-2 gap-2 h-[30rem] bg-black border-4 border-black overflow-hidden">
                    @php
                        $fotos = [1, 2, 3, 4, 5]; 
                    @endphp

                    @foreach ($fotos as $index => $foto)
                        <div
                            class="relative group bg-gray-200 overflow-hidden border-1 border-black {{ $index === 0 ? 'col-span-2 row-span-2' : '' }}">
                            <div
                                class="w-full h-full flex items-center justify-center hover:scale-105 transition-transform duration-500">
                                <span class="font-black text-2xl text-gray-400">FOTO {{ $index + 1 }}</span>
                                <div
                                    class="absolute bottom-2 left-2 bg-white border-2 border-black px-2 py-1 text-[10px] font-black uppercase">
                                    image_{{ $index + 1 }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button onclick="openModal('Galeria', 'Interface de fotos aqui')"
                        class="absolute bottom-6 right-6 bg-white border-4 border-black px-4 py-2 font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:translate-x-0 active:translate-y-0 active:shadow-none transition-all cursor-pointer">
                        Ver todas as fotos
                    </button>
                </div>
            </div>

            <!-- Descrição -->
            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-grow">
                <h2 class="text-2xl font-black uppercase mb-4 underline decoration-yellow-400">Descrição do Imóvel</h2>
                <p class="font-bold text-gray-800 leading-relaxed">
                    {{ $job->property->description ?? 'Nenhuma descrição detalhada fornecida para este local.' }}
                </p>
            </div>
        </div>

        <!-- Tarefas e Ação -->
        <div class="flex flex-col gap-6 h-full">

            <!-- Bloco da Lista de tarefas-->
            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-grow">
                <h2 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-2 inline-block">
                    Checklist de Limpeza
                </h2>

                <div class="space-y-4">
                    @if(!empty($job->tasks) && is_array($job->tasks))
                        @foreach (array_slice($job->tasks, 0, 3) as $task)
                            <div
                                class="flex items-center gap-3 p-3 border-2 border-black bg-gray-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">

                                <!-- Checkbox  -->
                                <div class="w-6 h-6 border-2 border-black flex-shrink-0 bg-white flex items-center justify-center">
                                    @if($task['is_required'])
                                        <div class="w-3 h-3 bg-red-500"></div>
                                    @else
                                        <div class="w-3 h-3 bg-black opacity-20"></div>
                                    @endif
                                </div>

                                <div class="flex flex-col">
                                    <span class="font-bold text-sm uppercase">
                                        {{ $task['task'] }}
                                    </span>

                                    @if($task['is_required'])
                                        <span class="text-[9px] font-black uppercase text-red-500 tracking-tighter">
                                            [ Obrigatório ]
                                        </span>
                                    @endif
                                </div>

                                <!-- importancia -->
                                @if($task['importance_level'] >= 7)
                                    <div
                                        class="absolute -right-1 -top-1 bg-yellow-400 border-l-2 border-b-2 border-black px-2 py-0.5 text-[8px] font-black uppercase">
                                        Prioridade {{ $task['importance_level'] }}
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        @if(count($job->tasks) > 3)
                            <div class="w-full flex justify-center mt-4">
                                <span
                                    class="font-black uppercase text-xs bg-black text-white px-2 py-1 shadow-[2px_2px_0px_0px_rgba(250,204,21,1)]">
                                    +{{ count($job->tasks) - 3 }} tarefas extras
                                </span>
                            </div>
                        @endif
                    @else
                        <div class="border-2 border-dashed border-black p-4 text-center">
                            <p class="italic text-gray-400 font-bold uppercase text-xs">Nenhuma tarefa listada</p>
                        </div>
                    @endif
                </div>

                <div class="mt-4 pt-6 border-t-4 border-black flex items-center gap-4">
                    <div
                        class="w-12 h-12 border-4 border-black bg-blue-400 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center font-black text-white text-xl uppercase">
                        {{ substr($job->property->owner->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-black uppercase text-[10px] text-gray-500 italic leading-none">Proprietário</p>
                        <p class="font-bold text-sm uppercase">{{ $job->property->owner->name ?? 'Não informado' }}</p>
                        <div class="flex items-center gap-1">
                            <span class="text-xs font-black">⭐ {{ $job->property->rating ?? '5.0' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Ação / Status -->
            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="space-y-4">
                    <div
                        class="bg-white border-2 border-black p-2 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
                        <p class="text-[10px] font-black uppercase text-gray-500">Valor Ofertado</p>
                        <p class="text-xl font-black text-green-600">R$ {{ number_format($job->price, 2, ',', '.') }}</p>
                    </div>

                    <div
                        class="bg-white border-2 border-black p-2 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
                        <p class="text-[10px] font-black uppercase text-gray-500">Data e Hora</p>
                        <p class="text-xs font-black">{{ \Carbon\Carbon::parse($job->scheduled_at)->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @if (Auth::check())
                        @if ($job->cleaner_user_id === auth()->id())
                            <div class="bg-green-500 text-white p-3 border-2 border-black text-center font-black uppercase text-xs">
                                VOCÊ É O RESPONSÁVEL 🧹
                            </div>
                        @elseif($job->property->owner_user_id === auth()->id())
                            <button onclick="manageJob({{ $job->id }})"
                                class="w-full py-3 bg-blue-500 text-white border-4 border-black font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1 hover:shadow-none transition-all">
                                GERENCIAR TRABALHO
                            </button>
                        @elseif($job->applications->contains('cleaner_id', auth()->id()))
                            <div class="bg-white border-4 border-black p-3 text-center">
                                <p class="font-black text-xs uppercase italic">Aguardando aprovação...</p>
                            </div>
                        @else
                            <button onclick="applyForJob({{ $job->id }})"
                                class="w-full py-3 bg-black text-white border-4 border-black font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(250,204,21,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all cursor-pointer">
                                ENVIAR PROPOSTA
                            </button>
                        @endif
                    @else
                        <a href="{{ route('user.login') }}"
                            class="block w-full py-3 bg-white border-4 border-black text-center font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            FAÇA LOGIN PARA APLICAR
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>

        function manageJob(jobId) {
            const title = 'Painel do Proprietário';

            // Pegamos as candidaturas diretamente da variável Blade enviada pelo controlador
            const applications = @json($job->applications);

            let applicationsHtml = '';

            if (applications.length > 0) {
                applications.forEach(application => {
                    const cleanerName = application.cleaner ? application.cleaner.name : 'Candidato Desconhecido';
                    const statusColor = application.status === 'pending' ? 'bg-yellow-400' : 'bg-green-400';

                    applicationsHtml += `
                    <div class="border-4 border-black bg-white p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] mb-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-black uppercase text-lg leading-tight">${cleanerName}</h4>
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Status: ${application.status}</p>
                            </div>
                            <div class="w-10 h-10 border-2 border-black bg-purple-400 flex items-center justify-center font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                ${cleanerName.charAt(0)}
                            </div>
                        </div>

                        <div class="bg-gray-100 border-2 border-black p-3 mb-4 shadow-[inset_2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <p class="text-xs font-bold italic text-gray-700">
                                "${application.message || 'O candidato não enviou uma mensagem.'}"
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <form action="/accept-application/${application.id}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="w-full py-2 bg-green-500 border-2 border-black font-black uppercase text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all cursor-pointer">
                                    Aceitar
                                </button>
                            </form>
                            <form action="/reject-application/${application.id}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="w-full py-2 bg-red-500 border-2 border-black font-black uppercase text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all cursor-pointer text-white">
                                    Recusar
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                });
            } else {
                applicationsHtml = `
                <div class="border-4 border-dashed border-black p-8 text-center bg-gray-50">
                    <p class="font-black uppercase text-gray-400 italic">Nenhuma candidatura recebida ainda.</p>
                </div>
            `;
            }

            const body = `
            <div class="p-1">
                <div class="max-h-[450px] overflow-y-auto custom-scrollbar pr-2">
                    ${applicationsHtml}
                </div>
            </div>
        `;

            openModal(title, body);
        }

        function applyForJob(jobId) {
            const title = 'Formulário de Aplicação';
            const body = `
                        <div class="p-2">
                            <form id="applyForm" action="/applyjob/${jobId}" method="POST" onsubmit="return validarConfirmacao()">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="mb-4">
                                        <label class="block mb-2 font-black uppercase text-sm" for="message">Deixe uma mensagem! (Opcional)</label>
                                        <input type="text" id="message" name="message" 
                                        placeholder="Olá, me chamo {{ Auth::check() ? Auth::user()->name : '' }}"
                                        class="w-full p-2 border-4 border-black outline-none focus:bg-yellow-50 font-bold shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                        <br><br>
                                        <label class="block mb-2 font-black uppercase text-xs" for="confirmacaoInput">
                                            Você concorda em realizar todas as atividades exigidas?
                                        </label>
                                        <input type="text" id="confirmacaoInput" name="requiredConsentiment" 
                                        placeholder="Digite 'SIM' para confirmar"
                                        class="w-full p-2 border-4 border-black outline-none focus:bg-yellow-50 font-bold shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]" required>
                                        <p id="errorMessage" class="text-red-600 font-black mt-2 hidden uppercase text-[10px]">Escreva 'SIM' em maiúsculo!</p>
                                    </div>
                                    <button type="submit" class="w-full p-3 bg-green-500 border-4 border-black font-black uppercase hover:bg-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                        Confirmar Candidatura
                                    </button>
                                </form>
                            </div>
            `;
            openModal(title, body);
        }

        function validarConfirmacao() {
            const input = document.getElementById('confirmacaoInput');
            const error = document.getElementById('errorMessage');
            if (input.value.trim().toUpperCase() !== 'SIM') {
                error.classList.remove('hidden');
                return false;
            }
            return true;
        }
    </script>
@endsection
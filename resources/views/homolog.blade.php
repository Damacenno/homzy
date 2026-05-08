@extends('layout')

@section('content')
    <div class="mb-6">
        <h1
            class="text-4xl font-black uppercase italic bg-black text-white inline-block px-4 py-2 shadow-[4px_4px_0px_0px_rgba(250,204,21,1)]">
            Detalhes
        </h1>
    </div>

    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2 flex flex-col gap-6">
            <div class="border-4 border-black bg-white p-4 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div
                    class="relative grid grid-cols-4 grid-rows-2 gap-2 h-[30rem] bg-black border-4 border-black overflow-hidden shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="relative group bg-gray-200 overflow-hidden border-1 border-black
                                                            {{ $i === 1 ? 'col-span-2 row-span-2' : '' }} 
                                                            {{ $i > 5 ? 'hidden' : '' }}">
                            <div
                                class="w-full h-full flex items-center justify-center hover:scale-105 transition-transform duration-500">
                                <span class="font-black text-2xl text-gray-400">IMG {{ $i }}</span>
                                <div
                                    class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity cursor-pointer">
                                </div>
                                <div
                                    class="absolute bottom-2 left-2 bg-white border-2 border-black px-2 py-1 text-[10px] font-black uppercase">
                                    Foto_{{ $i }}
                                </div>
                            </div>
                        </div>
                    @endfor

                    <button onclick="openModal('Galeria Completa', 'Fotos')"
                        class="absolute bottom-6 right-6 bg-white border-4 border-black px-4 py-2 font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:translate-x-0 active:translate-y-0 active:shadow-none transition-all cursor-pointer">
                        Ver todas as fotos
                    </button>
                </div>
            </div>

            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-grow">
                <h2 class="text-2xl font-black uppercase mb-4 underline">Descrição do Serviço</h2>
                <div class="space-y-4">
                    <div class="h-4 bg-gray-200 w-full border border-black/10"></div>
                    <div class="h-4 bg-gray-200 w-5/6 border border-black/10"></div>
                    <div class="h-4 bg-gray-200 w-4/6 border border-black/10"></div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6 h-full">

            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-grow">
                <h2 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-2 inline-block">Lista de Afazeres
                </h2>

                <div class="space-y-4">
                    @for ($j = 1; $j <= 3; $j++)
                        <div
                            class="flex items-center gap-3 p-3 border-2 border-black bg-gray-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <div class="w-6 h-6 border-2 border-black flex-shrink-0 bg-white flex items-center justify-center">
                                <div class="w-3 h-3 bg-black opacity-20"></div>
                            </div>
                            <span class="font-bold text-sm uppercase">Tarefa pendente número {{ $j }}</span>
                        </div>
                    @endfor
                    <div class="w-full flex justify-center">
                        <h1 class="font-bold uppercase">+7 tarefas</h1>
                    </div>
                </div>

                <div class="mt-2 pt-6 border-t-2 border-black/10 flex items-center gap-4">
                    <div class="w-12 h-12 border-4 border-black bg-blue-400 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"></div>
                    <div>
                        <p class="font-black uppercase text-xs">Proprietário</p>
                        <p class="font-bold text-sm">Nome do Dono</p>
                    </div>
                </div>
            </div>


            <div class="border-4 border-black bg-white p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="space-y-4">
                    <div
                        class="bg-white border-2 border-black p-2 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
                        <p class="text-[10px] font-black uppercase text-gray-500">Valor</p>
                        <p class="text-xl font-black text-green-600">R$ 0,00</p>
                    </div>

                    <div
                        class="bg-white border-2 border-black p-2 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
                        <p class="text-[10px] font-black uppercase text-gray-500">Data</p>
                        <p class="text-xs font-black">--/--/-- às --:--</p>
                    </div>

                    <div class="bg-black text-white p-2 text-center font-black uppercase text-xs tracking-tighter">
                        Status: Aceitando Candidatos
                    </div>

                    <button
                        class="w-full py-3 bg-white border-4 border-black font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-black hover:text-white transition-all cursor-pointer">
                        Candidatar-se
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
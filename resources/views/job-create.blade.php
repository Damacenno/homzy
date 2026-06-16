@extends('layout')

@section('content')
<div class="max-w-md mx-auto my-12 bg-white border-4 border-black p-6 shadow-[10px_10px_0_0_rgba(0,0,0,1)]">
    <h2 class="text-2xl font-black uppercase tracking-tight mb-6 bg-lime-400 border-2 border-black inline-block px-3 py-1">
        Nova Faxina
    </h2>

    <form action="{{ route('job.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block font-black uppercase text-sm mb-2">Selecione o seu Imóvel</label>
            <select name="property_id" class="w-full bg-white border-4 border-black p-3 font-bold focus:outline-none focus:bg-amber-100">
                @foreach($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full text-center border-4 border-black py-3 bg-[#facc15] font-black uppercase tracking-tight shadow-[4px_4px_0_0_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
            Publicar Oferta de Faxina
        </button>
    </form>
</div>
@endsection
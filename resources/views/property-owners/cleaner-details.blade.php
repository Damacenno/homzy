@extends('layout')

@section('content')
    <h1>Detalhes do Profissional de Limpeza</h1>
    <p><strong>Nome:</strong> {{ $cleaner->name }}</p>
    <p><strong>Descrição:</strong> {{ $cleaner->brief_description }}</p>
    <h2>Habilidades</h2>
    <ul>
        @foreach($cleaner->top_skills as $skill)
            <li>{{ $skill['Name'] }} - Nível: {{ $skill['Level'] }}</li>
        @endforeach
    </ul>
@endsection
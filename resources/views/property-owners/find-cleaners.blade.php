@extends('layout')

@section('content')
    <h1>Encontre os melhores profissionais de limpeza para sua casa</h1>
    <div class="flex flex-wrap">
        @foreach($cleaners as $cleaner)
            <a href="{{ route('cleaner.details', $cleaner->id) }}" class="border-2 border-gray-300 rounded-lg p-4 m-2 w-1/3">
                    <h2 class="text-xl font-bold mb-2">{{ $cleaner->name }}</h2>
                    <ul class="flex">
                        @foreach($cleaner->top_skills as $skill)
                            <li class="border-1 border-gray-200 rounded-lg p-2">{{ $skill['Name'] }}</li>
                        @endforeach
                    </ul>
            </a>
        @endforeach
@endsection
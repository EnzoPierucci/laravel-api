@extends('layouts.app')

@section('content')

<main class="container py-3">
    
    <h1 class="mt-2">{{$project->title}}</h1>

    <h4 class="mt-2">Immagine Homepage</h4>
    @if($project->thumb)
        <img src="{{ asset('/storage/'.$project->thumb)}}" alt="" class="col-6 mb-3">
    @endif

    <h4 class="mt-2">Tipo di progetto</h4>
    <ul>
            <li>{{ $project->type->name }}</li>
    </ul>

    <h4 class="mt-2">Tecnologie Utilizzate:</h4>
    <ul>
        @foreach($project->technologies as $technology)
            <li>{{ $technology->name }}</li>
        @endforeach
    </ul>

    <h4 class="mt-2">Descrizione</h4>
    <p>
        {{$project->descriptions}}
    </p>


</main>
        
@endsection
@extends('layouts.admin')

@section('content')
<div class="container p-5">
    <div class="d-flex align-items-center justify-content-center">
        <h1 class="me-4">{{ $project->title}}</h1>
        @include('admin.partials.form-delete')
    </div>



    <div class="d-flex justify-content-between align-items-center">
        <h6 class="text-center m-3">Tipologia: {{ $project->type}}</h6>
        <span>Data di creazione: {{ $project->date_creation}}</span>
    </div>


    {{-- Immagine qui!!!! --}}
    <div class="d-flex justify-content-center">
        <img class="w-50" src="{{ asset('storage/' . $project->thumb) }}" alt="{{  $project->title }}">
    </div>

    <p class="p-4"> {!! $project->description !!} </p>

</div>
@endsection

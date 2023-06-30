@extends('layouts.admin')

@section('content')
<div class="container p-5">

    @if (session('delete'))
        <div class="alert alert-success" role="alert">
            {{ session('delete') }}
        </div>
    @endif

    <h4 class="mb-3">Elenco progetti</h4>

    <a href="{{ route('admin.projects.create')}}" class="btn btn-primary mb-4"> Inserisci nuovo progetto </a>

    <table class="table">
        <thead>
            <tr>
            <th scope="col"><a href="{{ route('admin.orderby', ['direction'=> $direction]) }}">#ID</a></th>
            <th scope="col">Titolo progetto</th>
            <th scope="col">Tipologia</th>
            <th scope="col">Data di creazione</th>
            <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td><span class="badge text-bg-primary">{{ $project->category->name }}</span></td>

                <@php
                    $date = date_create($project->date_creation);
                @endphp
                <td>{{ date_format($date, 'd/m/Y')}}</td>
                <td>
                    <a href="{{ route('admin.projects.show' , $project) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('admin.projects.edit' , $project) }}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>

                    @include('admin.partials.form-delete')
                </td>
            </tr>
            @endforeach

        </tbody>
        </table>

        <div>
            {{ $projects->links() }}
        </div>

</div>
@endsection

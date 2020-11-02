@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
<div class="dimasol-row-padding dimasol-padding-32 dimasol-container">
    <h1 class="dimasol-margin">Detalles del Proyecto</h1>
    <div class="dimasol-container dimasol-half">
        {{-- Mitad izq --}}
        <ul class="list-group list-group-flush">
            <input type="hidden" value="{{ $projects->id }}">
            <li class="list-group-item"><h5>Nombre del projecto: </h5>{{$projects->projectName}}</li>
            <li class="list-group-item"><h5>Descripcion: </h5>{{$projects->projectDescription}}</li>
            <li class="list-group-item"><h5>Compañia: </h5>{{$projects->company}}</li>
            <li class="list-group-item"><h5>Area: </h5>{{$projects->area}}</li>
            <li class="list-group-item"><h5>Requisitado por: </h5>{{$projects->requisitedBy}}</li>
            <li class="list-group-item"><h5>Fecha de inicio: </h5>{{$projects->startDate}}</li>
            <li class="list-group-item"><h5>Fecha de finalización: </h5>{{$projects->endDate}}</li>
        </ul><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/projects/">Regreso al catálogo</a></li>
                <li class="breadcrumb-item"><a href="/projects/edit/{{$projects->id}}">Editar</a></li>
                <li class="breadcrumb-item"><a href="/projects/delete/{{$projects->id}}">Borrar</a></li>
                <li class="breadcrumb-item"><a href="/dataentry/create/{{ $projects->id }}">Agregar actividades</a> </li>
            </ol> </nav>
    </div>
    <div class="dimasol-container dimasol-half">
        {{-- Mitad derecha - timeline --}}

    </div>
</div>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

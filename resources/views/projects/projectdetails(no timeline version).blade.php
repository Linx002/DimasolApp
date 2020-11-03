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
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><h5>Inicio de Proyecto: </h5>{{$projects->startDate}}</li>
            {{-- entradas de datos --}}
        @if (count($projects->dataentries) > 0)
        @foreach ($projects->dataentries as $entries)
        @if ($entries->entrytype == "CompraMat")
        <ul class="list-group">
            <li class="list-group-item list-group-item-primary">
                <div class="d-flex w-100 justify-content-between">
                <h5>Compra de materiales para proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
            <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
            </li>
        </ul>
        @endif
        @if ($entries->entrytype == "Protos")
        <ul class="list-group">
            <li class="list-group-item list-group-item-secondary">
                <div class="d-flex w-100 justify-content-between">
                <h5>Muestreo de prototipo del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
            <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
            </li>
        </ul>
        @endif
        @if ($entries->entrytype == "Avance25")
        <ul class="list-group">
            <li class="list-group-item list-group-item-dark">
                <div class="d-flex w-100 justify-content-between">
                <h5>Revision del 25% del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
            <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
            </li>
        </ul>
        @endif
        @if ($entries->entrytype == "Avance50")
        <ul class="list-group">
            <li class="list-group-item list-group-item-warning">
                <div class="d-flex w-100 justify-content-between">
                <h5>Revision del 50% del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
            <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
            </li>
        </ul>
        @endif
        @if ($entries->entrytype == "Avance75")
        <ul class="list-group">
            <li class="list-group-item list-group-item-info">
                <div class="d-flex w-100 justify-content-between">
                <h5>Revision del 75% del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
            <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
            </li>
        </ul>
        @endif
        @if ($entries->entrytype == "Final")
        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                <div class="d-flex w-100 justify-content-between">
                <h5>Entrega del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
            <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
            </li>
        </ul>
        @endif
        @endforeach
        @else
            <p class="dimasol-center">
                Proyecto sin actividades.
            </p>
        @endif
        <li class="list-group-item"><h5>Terminacion de proyecto: </h5>{{$projects->endDate}}</li>
    </div>
</div>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

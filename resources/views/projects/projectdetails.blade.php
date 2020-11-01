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
        <a href="/project/">Regreso al catálogo</a> |
        <a href="/project/edit/{{$projects->id}}">Editar</a> |
        <a href="/project/delete/{{$projects->id}}">Borrar</a> |
        <a href="/dataentry/create/{{ $projects->id }}">Agregar actividades</a>
    </div>
    <div class="dimasol-container dimasol-half">
        {{-- Mitad derecha - timeline --}}

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><h5>Inicio de Proyecto: </h5>{{$projects->startDate}}</li>
            {{-- entradas de datos --}}
            @if (count($projects->dataentries) > 0)
            @foreach ($projects->dataentries as $entries)
            @if ($entries->entrytype == "CompraMat")
            <li class="list-group-item dimasol-light-grey"><h5>Compra de materiales para proyecto</h5>
            {{ $entries->entryDescription }}<br>
            Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}<br>
            <a href="/dataentry/deleteentry/{{ $entries->id }}" class="btn btn-danger">Borrar</a>
            <a href="/dataentry/editentry/{{ $entries->id }}" class="btn btn-warning">Editar</a>
            </li>
            @endif
            @if ($entries->entrytype == "Protos")
            <li class="list-group-item dimasol-pale-green"><h5>Muestreo de prototipo del proyecto</h5>
            {{ $entries->entryDescription }}<br>
            Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}<br>
            <a href="/dataentry/deleteentry/{{ $entries->id }}" class="btn btn-danger">Borrar</a>
            <a href="/dataentry/editentry/{{ $entries->id }}" class="btn btn-warning">Editar</a>
            </li>
            @endif
            @if ($entries->entrytype == "Avance25")
            <li class="list-group-item dimasol-pale-blue"><h5>Revision del 25% del proyecto</h5>
            {{ $entries->entryDescription }}<br>
            Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}<br>
            <a href="/dataentry/deleteentry/{{ $entries->id }}" class="btn btn-danger">Borrar</a>
            <a href="/dataentry/editentry/{{ $entries->id }}" class="btn btn-warning">Editar</a>
            </li>
            @endif
            @if ($entries->entrytype == "Avance50")
            <li class="list-group-item dimasol-pale-red"><h5>Revision del 50% del proyecto</h5>
            {{ $entries->entryDescription }}<br>
            Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}<br>
            <a href="/dataentry/deleteentry/{{ $entries->id }}" class="btn btn-danger">Borrar</a>
            <a href="/dataentry/editentry/{{ $entries->id }}" class="btn btn-warning">Editar</a>
            </li>
            @endif
            @if ($entries->entrytype == "Avance75")
            <li class="list-group-item dimasol-pale-yellow"><h5>Revision del 75% del proyecto</h5>
            {{ $entries->entryDescription }}<br>
            Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}<br>
            <a href="/dataentry/deleteentry/{{ $entries->id }}" class="btn btn-danger">Borrar</a>
            <a href="/dataentry/editentry/{{ $entries->id }}" class="btn btn-warning">Editar</a>
            </li>
            @endif
            @if ($entries->entrytype == "Final")
            <li class="list-group-item dimasol-indigo"><h5>Entrega del proyecto</h5>
            {{ $entries->entryDescription }}<br>
            Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}<br>
            <a href="/dataentry/deleteentry/{{ $entries->id }}" class="btn btn-danger">Borrar</a>
            <a href="/dataentry/editentry/{{ $entries->id }}" class="btn btn-warning">Editar</a>
            </li>
            @endif
            @endforeach
            @else
            <p>
                Proyecto sin actividades.
            </p>
            @endif
            <li class="list-group-item"><h5>Terminacion de proyecto: </h5>{{$projects->endDate}}</li>
        </ul>
    </div>
</div>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

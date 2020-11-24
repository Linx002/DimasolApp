@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (session('msg'))
<div class="dimasol-panel dimasol-blue dimasol-display-container">
    <span onclick="this.parentElement.style.display='none'"
    class="dimasol-button dimasol-large dimasol-display-topright">&times;</span>
<h3> Información! </h3>
    <p class="msg">{{ session('msg') }}</p>
</div>
@endif
<div class="dimasol-row-padding dimasol-padding-32 dimasol-container">
    <h1 class="dimasol-margin">Detalles del Proyecto</h1>
    <div class="dimasol-container dimasol-half">
        {{-- Mitad izq --}}
        <ul class="list-group list-group-flush">
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
                @if (Route::has('login'))
                @auth
                <li class="breadcrumb-item"><a href="/projects/edit/{{$projects->id}}">Editar</a></li>
                <li class="breadcrumb-item"><a href="/projects/delete/{{$projects->id}}">Borrar</a></li>
                <li class="breadcrumb-item"><a href="/dataentry/create/{{ $projects->id }}">Agregar actividades</a> </li>
                @endauth
                @endif
            </ol> </nav>
    </div>
    <div class="dimasol-container dimasol-half">
        {{-- Mitad derecha - timeline --}}
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><h5>Inicio de Proyecto: </h5>{{$projects->startDate}}</li>
            {{-- entradas de datos --}}
        @if (count($projects->dataentries) > 0)
        @foreach ($projects->dataentries->sortBy('sortPos') as $entries)
        @if ($entries->entrytype == "CompraMat")
        <li class="list-group-item col-order-1 list-group-item-primary">
            <div class="d-flex w-100 justify-content-between">
                <h5>Compra de materiales para proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <div class="row">
                @if (Route::has('login'))
                @auth
                <div class="col-6">
                    <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
                    <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
                </div>
                @endauth
                @endif
                <div class="col-6 justify-content-end">
                @if ($entries->entryFile == "No_file_uploaded")
                <small>Esta actividad no contiene archivos.</small>
                @else
                <a class="badge badge-info badge-pill" href="/public/{{$entries->entryType}}/{{$entries->entryFile}}">Ver archivo adjunto</a>
                @endif
                </div>
            </div>
        </li>
        @endif
        @if ($entries->entrytype == "Protos")
        <li class="list-group-item col-order-2 list-group-item-secondary">
            <div class="d-flex w-100 justify-content-between">
                <h5>Muestreo de prototipo del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <div class="row">
                @if (Route::has('login'))
                @auth
                <div class="col-6">
                    <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
                    <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
                </div>
                @endauth
                @endif
                <div class="col-6 justify-content-end">
                @if ($entries->entryFile == "No_file_uploaded")
                <small>Esta actividad no contiene archivos.</small>
                @else
                <a class="badge badge-info badge-pill" href="/public/{{$entries->entryType}}/{{$entries->entryFile}}">Ver archivo adjunto</a>
                @endif
                </div>
            </div>
        </li>
        @endif
        @if ($entries->entrytype == "Avance25")
        <li class="list-group-item list-group-item-dark col-order-3">
            <div class="d-flex w-100 justify-content-between">
                <h5>Revision del 25% del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <div class="row">
                @if (Route::has('login'))
                @auth
                <div class="col-6">
                    <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
                    <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
                </div>
                @endauth
                @endif
                <div class="col-6 justify-content-end">
                @if ($entries->entryFile == "No_file_uploaded")
                <small>Esta actividad no contiene archivos.</small>
                @else
                <a class="badge badge-info badge-pill" href="/public/{{$entries->entryType}}/{{$entries->entryFile}}">Ver archivo adjunto</a>
                @endif
                </div>
            </div>
        </li>
        @endif
        @if ($entries->entrytype == "Avance50")
        <li class="list-group-item list-group-item-warning col-order-4">
            <div class="d-flex w-100 justify-content-between">
                <h5>Revision del 50% del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <div class="row">
                @if (Route::has('login'))
                @auth
                <div class="col-6">
                    <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
                    <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
                </div>
                @endauth
                @endif
                <div class="col-6 justify-content-end">
                @if ($entries->entryFile == "No_file_uploaded")
                <small>Esta actividad no contiene archivos.</small>
                @else
                <a class="badge badge-info badge-pill" href="/public/{{$entries->entryType}}/{{$entries->entryFile}}">Ver archivo adjunto</a>
                @endif
                </div>
            </div>
        </li>
        @endif
        @if ($entries->entrytype == "Avance75")
        <li class="list-group-item col-order-5 list-group-item-info">
            <div class="d-flex w-100 justify-content-between">
                <h5>Revision del 75% del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <div class="row">
                @if (Route::has('login'))
                @auth
                <div class="col-6">
                    <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
                    <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
                </div>
                @endauth
                @endif
                <div class="col-6 justify-content-end">
                @if ($entries->entryFile == "No_file_uploaded")
                <small>Esta actividad no contiene archivos.</small>
                @else
                <a class="badge badge-info badge-pill" href="/public/{{$entries->entryType}}/{{$entries->entryFile}}">Ver archivo adjunto</a>
                @endif
                </div>
            </div>
        </li>
        @endif
        @if ($entries->entrytype == "Final")
            <li class="list-group-item col-order-6 list-group-item-success">
                <div class="d-flex w-100 justify-content-between">
                <h5>Entrega del proyecto</h5>
                <small>Entre las fechas {{ $entries->entryStartDate }}<===>{{ $entries->entryEndDate }}</small>
            </div><p>{{ $entries->entryDescription }}</p>
            <div class="row">
                @if (Route::has('login'))
                @auth
                <div class="col-6">
                    <a class="badge badge-danger badge-pill" href="/dataentry/deleteentry/{{ $entries->id }}">Borrar</a>
                    <a class="badge badge-warning badge-pill" href="/dataentry/editentry/{{ $entries->id }}">Editar</a>
                </div>
                @endauth
                @endif
                <div class="col-6 justify-content-end">
                @if ($entries->entryFile == "No_file_uploaded")
                <small>Esta actividad no contiene archivos.</small>
                @else
                <a class="badge badge-info badge-pill" href="/public/{{$entries->entryType}}/{{$entries->entryFile}}">Ver archivo adjunto</a>
                @endif
                </div>
            </div>
        </li>
        @endif
    </ul>
        @endforeach
        @else
            <p class="dimasol-center">
                Proyecto sin actividades.
            </p>
        @endif
        <li class="list-group-item"><h5>Terminacion de proyecto: </h5>{{$projects->endDate}}</li>
    </div>
</div>
@endsection

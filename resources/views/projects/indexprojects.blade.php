@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
@if (session('msg'))
<div class="dimasol-panel dimasol-blue dimasol-display-container">
    <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;</span>
<h3> Información! </h3>
    <p class="msg">{{ session('msg') }}</p>
</div>
@endif
<h1 class="dimasol-center dimasol-margin">Índice de proyectos - DIMASOL Industrial</h1>
<a href="/projects/create" class="button-radius dimasol-blue dimasol-hover-white dimasol-button">Nuevo proyecto</a>
<div class="dimasol-padding-16"> </div>
<div class="dimasol-container dimasol-blue-grey dimasol-table dimasol-padding-16">
    <table class="dimasol-table">
        <thead class="dimasol-blue">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Proyecto</th>
                <th scope="col">Compañía</th>
                <th scope="col">Area</th>
                <th scope="col">Estatus</th>
                <th scope="col">Requisitado por</th>
                <th class="dimasol-center" scope="col">Operaciones</th>
            </tr>
        </thead>
        @foreach ($projects as $project)
        @php
        $dateToCompare = $project->endDate;
        $today = date('Y-m-d');
        if ($dateToCompare<$today){
            $status="Projecto terminado";
        }
        else if($dateToCompare==$today){
            $status="Projecto termina hoy";
        }
        else{
            $status="Projecto en producción";
        }
        @endphp
        <tbody class="dimasol-light-blue">
            <tr>
                <th scope="col">{{$project->id}}</th>
                <td scope="col">{{$project->projectName}}</td>
                <td scope="col">{{$project->company}}</td>
                <td scope="col">{{$project->area}}</td>
                <td scope="col">{{$status}}</td>
                <td scope="col">{{$project->requisitedBy}}</td>
                <td scope="col" class="dimasol-center">
                    <a href="/projects/{{$project->id}}" class="dimasol-button dimasol-hover-white">Detalles</a>
                    <a href="/projects/edit/{{$project->id}}" class="dimasol-button dimasol-hover-white">Editar</a>
                    <a href="/projects/delete/{{$project->id}}" class="dimasol-button dimasol-hover-white">Borrar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

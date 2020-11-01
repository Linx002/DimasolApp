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
<h1 class="dimasol-margin">Crear proyecto</h1>
<div class="dimasol-quarter dimasol-padding-16"></div>
<div class="dimasol-half dimasol-container dimasol-green dimasol-padding-16">
    <form action="/projects/create" method="POST" enctype="multipart/form-data">
        @csrf
        <ul class="list-group list-group-flush">
            <label for="name">Nombre del proyecto: </label>
            <input class="form-control" type="text" name="projectName" id="projectName" required autofocus/>
            <label for="projectDescription">Descripcion: </label>
            <textarea name="projectDescription" id="projectDescription" cols="25" rows="10" class="form-control"></textarea>
            <div class="form-row">
                <div class="col-md-4">
                <label for="company">Compañia: </label>
                <input class="form-control" type="text" name="company" id="company" required/>
                </div>
                <div class="col-md-4">
                <label for="area">Área: </label>
                <input class="form-control" type="text" name="area" id="area" required/>
                </div>
                <div class="col-md-4">
                <label for="requisited">Requisitado por: </label>
                <input class="form-control" type="text" name="requisitedBy" id="requisitedBy" required/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                <label for="startDate">Fecha de inicio: </label>
                <input class="form-control" type="date" min="2020-09-01" name="startDate" id="startDate" required/>
                </div>
                <div class="col-md-4">
                <label for="endDate">Fecha de finalizacion: </label>
                <input class="form-control" type="date" name="endDate" id="endDate" required/>
                </div>
                <div class="col-md-4">
                <label for="consumables">Requiere consumibles?: </label><br/>
                    <input type="radio" name="consumables" id="consumables" value=true> Si
                    <input type="radio" name="consumables" id="consumables" value=false> No
                {{--  <select class="dimasol-select" name="consumables" id="consumables" required>
                <option value=true>Si</option>
                <option value=false>No</option>
                </select>  --}}
                </div>
            </div>
        </ul>
    <div class="dimasol-padding-16">
        <button type="submit" class="dimasol-button button-radius btn-success btn">Crear proyecto</button>
        <button type="reset" class="dimasol-button button-radius btn-warning btn">Reset</button>
    </div>
</div>
</form>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection
@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
<h1 class="dimasol-margin">Agregar actividad al proyecto ({{ $projects->projectName }})</h1>
<div class="dimasol-quarter dimasol-padding-16"></div>
<div class="dimasol-half dimasol-container dimasol-amber dimasol-padding-16">
<form action="/dataentry/store" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value={{ $projects->id }} id="id" name="id">
    <ul class="list-group list-group-flush">
        <label for="entryTypes">Tipo de actividad: </label>
        <select class="form-control" name="entryType">
        <option class="value" name="entryType" id="entryType" value="CompraMat"> Compra de Material </option>
        <option class="value" name="entryType" id="entryType" value="Protos"> Presentacion de prototipos </option>
        <option class="value" name="entryType" id="entryType" value="Avance25"> 25% de Avance </option>
        <option class="value" name="entryType" id="entryType" value="Avance50"> 50% de Avance </option>
        <option class="value" name="entryType" id="entryType" value="Avance75"> 75% de Avance </option>
        <option class="value" name="entryType" id="entryType" value="Final"> Entrega de proyecto </option>

        </select>
        <label for="entryDescription">Descripcion: </label>
        <textarea name="entryDescription" id="entryDescription" cols="25" rows="10" class="form-control"></textarea>
        <label for="entryFile">Archivo: </label>
        <input class="form-control" type="file" name="entryFile" id="entryFile"/>
        <div class="form-row">
            <div class="col-md-6">
            <label for="entryStartDate">Fecha de inicio de actividad: </label>
            <input class="form-control" type="date" min="{{ $projects->startDate }}"  max="{{ $projects->endDate }}" name="entryStartDate" id="entryStartDate" required/>
            </div>
            <div class="col-md-6">
            <label for="entryEndDate">Fecha de finalizacion de actividad: </label>
            <input class="form-control" type="date" min="{{ $projects->startDate }}"  max="{{ $projects->endDate }}" name="entryEndDate" id="entryEndDate" required/>
            </div>
        </div>
        <div class="dimasol-padding-16">
            <button type="submit" class="dimasol-button button-radius btn-success btn">Agregar actividad</button>
            <button type="reset" class="dimasol-button button-radius btn-warning btn">Reset</button>
        </div>
</form>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

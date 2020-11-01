@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
<h1 class="dimasol-margin">Eliminar actividad</h1>
<div class="dimasol-quarter dimasol-padding-16"></div>
<div class="dimasol-half dimasol-container dimasol-red dimasol-padding-16">
<form action="/dataentry/deleteentry" method="POST" enctype="multipart/form-data">
    @csrf
    @method('DELETE')
    <input type="hidden" value={{ $entry->id }} id="id" name="id">
    <ul class="list-group list-group-flush">
        @php
            if($entry->entrytype == "CompraMat"){
                $entryToShow = "Compra de materiales para proyecto";
            }
            if($entry->entrytype == "Protos"){
                $entryToShow = "Muestreo de prototipo del proyecto";
            }
            if($entry->entrytype == "Avance25"){
                $entryToShow = "Revision del 25% del proyecto";
            }
            if($entry->entrytype == "Avance50"){
                $entryToShow = "Revision del 50% del proyecto";
            }
            if($entry->entrytype == "Avance75"){
                $entryToShow = "Revision del 75% del proyecto";
            }
            if($entry->entrytype == "Final"){
                $entryToShow = "Entrega del proyecto";
            }
            @endphp
        <label for="entryTypes">Tipo de actividad:</label>

        <select class="form-control" name="entryType" disabled>
            <option class="value"
            @php
                if($entry->entrytype == "CompraMat"){
                    echo "selected";
                }
            @endphp
            name="entryType" id="entryType" value="CompraMat"> Compra de Material </option>
            <option class="value" name="entryType" id="entryType" value="Protos"> Presentacion de prototipos </option>
            <option class="value" name="entryType" id="entryType" value="Avance25"> 25% de Avance </option>
            <option class="value" name="entryType" id="entryType" value="Avance50"> 50% de Avance </option>
            <option class="value" name="entryType" id="entryType" value="Avance75"> 75% de Avance </option>
            <option class="value" name="entryType" id="entryType" value="Final"> Entrega de proyecto </option>
        </select>
        <label for="entryDescription">Descripcion: </label>
        <textarea name="entryDescription" id="entryDescription" cols="25" rows="10" class="form-control" readonly> {{ $entry->entryDescription }}</textarea>
        <label for="entryFile">Archivo: </label>
        <input class="form-control" type="file" name="entryFile" id="entryFile" value="{{ $entry->entryFile }}" readonly/>
        <div class="form-row">
            <div class="col-md-4">
            <label for="entryStartDate">Fecha de inicio de actividad: </label>
            <input class="form-control" type="date" name="entryStartDate" id="entryStartDate" value="{{ $entry  ->entryStartDate }}" readonly/>
            </div>
            <div class="col-md-4">
            <label for="entryEndDate">Fecha de finalizacion de actividad: </label>
            <input class="form-control" type="date" name="entryEndDate" id="entryEndDate" value="{{ $entry->entryEndDate }}" readonly/>
            </div>
        </div>
        <div class="dimasol-padding-16">
            <button type="submit" class="dimasol-button button-radius btn-danger btn">Eliminar actividad</button>
            <button type="reset" class="dimasol-button button-radius btn-warning btn">Reset</button>
            <a href="/projects/{{ $entry->projects_id }}" class="dimasol-button button-radius btn btn-info">Regresar a proyecto</a>
        </div>
</form>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

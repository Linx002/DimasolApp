@extends('layouts.layoutdimasol(blue)')
@section('content')
<h1>Contacto</h1>
<p>Nos puede encontrar en la siguiente dirección:</p><br>
<p> Ubicación: Calle Cristóbal de Olid #69 Col. Inf. Conquistadores, Cd. Rio Bravo, Tamaulipas. C.P. 88993</p>
<div class="dimasol-center dimasol-row-padding dimasol-light-grey dimasol-padding-64 dimasol-container">
    <img style="width:20%" src="{{ url('/img/dimasol-location.jpg') }}" onclick="document.getElementById('locacion').style.display='block'" class="dimasol-hover-opacity">

    <div id="locacion" class="dimasol-modal dimasol-animate-zoom" onclick="this.style.display='none'">
        <img class="dimasol-modal-content" src="{{ url('/img/dimasol-location.jpg') }}">
    </div>
</div>
<br>
@include('layouts.contactform')
@endsection

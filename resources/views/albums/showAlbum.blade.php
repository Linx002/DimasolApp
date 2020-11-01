@extends('layouts.layoutdimasol(blue)')
@section('content')
<h1>{{ $album->albumName }}</h1>
@if (session('msg'))
<div class="dimasol-panel dimasol-blue dimasol-display-container">
    <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;</span>
<h3> Información! </h3>
    <p class="msg">{{ session('msg') }}</p>
</div>
@endif
<div id="photos" class="dimasol-padding dimasol-container dimasol-light-grey">
    @if (count($album->photos) > 0 )
    @php
        $colCount = count($album->photos);
        $i = 1;
    @endphp
    <div class="dimasol-row dimasol-center dimasol-centered">
        @foreach ($album->photos as $photo)
        @if ($i == $colCount)
        <div class="dimasol-quarter end">
            <h4> {{ $photo->photoTitle }}</h4>
                <img src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}" width="200px" alt="{{ $photo->photoTitle }}" onclick="document.getElementById('{{ $i }}').style.display='block'" class="dimasol-hover-opacity img-circle">
                <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;</span>
                <div id="{{ $i }}" class="dimasol-modal dimasol-animate-zoom" onclick="this.style.display='none'">
                    <img class="dimasol-modal-content" src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}">
                </div>

        @else
        <div class="dimasol-quarter">
            <div class="dimasol-container">
            <h4> {{ $photo->photoTitle }}</h4>
                <img src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}" width="200px" alt="{{ $photo->photoTitle }}" onclick="document.getElementById('{{ $i }}').style.display='block'" class="dimasol-hover-opacity img-circle">
                <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;</span>
                <div id="{{ $i }}" class="dimasol-modal dimasol-animate-zoom" onclick="this.style.display='none'">
                    <img class="dimasol-modal-content" src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}">
                </div>
            </div>
                <br>
        @endif
        @if($i % 3 == 0)
        </div></div><div class="dimasol-row dimasol-center dimasol-centered">
            @else
            </div>
        @endif
            @php
                $i++;
            @endphp
        @endforeach
    </div>
</div>
@else
    <p> No hay fotos que mostrar </p>
    @endif
@if (Route::has('login'))
@auth
<a href="/album/admin" class="btn button-radius btn-primary">Regresar a administrar</a>
<a href="/album/delete/{{ $album->id }}" class="btn button-radius btn-danger">Eliminar álbum</a>
<a href="/photo/add/{{ $album->id }}" class="btn button-radius btn-warning">Agregar más fotos</a>
@else
    @endif
    <a class="btn button-radius btn-default" href="/areas">Regresar</a>
    @endauth
@endsection

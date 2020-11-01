@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
    <h1>Borrar álbum -> {{ $album->albumName }}</h1>
    <form action="/album/delete" method="POST">
        @csrf
        @method('DELETE')
    <input value="{{ $album->id }}" type="hidden">
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
                <img src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}" width="200px" alt="{{ $photo->photoTitle }}" onclick="document.getElementById('locacion').style.display='block'" class="dimasol-hover-opacity img-circle">
                <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;<a href=""></span>
                <div id="locacion" class="dimasol-modal dimasol-animate-zoom" onclick="this.style.display='none'">
                <img class="dimasol-modal-content" src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}">
                </div>
            @else
            <div class="dimasol-quarter">
                <h4> {{ $photo->photoTitle }}</h4>
                <div class="dimasol-container">
                    <img src="/storage/photos/{{ $photo->album_id }}/{{ $photo->photo }}" width="200px" alt="{{ $photo->photoTitle }}" onclick="document.getElementById('locacion').style.display='block'" class="dimasol-hover-opacity img-circle">
                    <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;<a href=""></span>
                    <div id="locacion" class="dimasol-modal dimasol-animate-zoom" onclick="this.style.display='none'">
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
        <p>Álbum vacío</p>
        @endif
    <a href="/album/admin" class="btn button-radius btn-primary">Regresar a administrar</a>
    <button type="submit" class="btn button-radius btn-danger">Eliminar álbum</button>
@else
        <h1>Necesita iniciar sesión para ver este contenido.</h1>
        <a class="btn button-radius btn-default" href="/areas">Regresar</a>
        @endauth
        @endif
@endsection

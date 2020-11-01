@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
<meta name="csrf-token" value="{{ csrf_token() }}" />
<h1>Agregar fotos al álbum </h1>
<div class="dimasol-quarter dimasol-container"></div>
<div class="dimasol-col dimasol-col-padding dimasol-container dimasol-padding-16">
    <div class="dimasol-container dimasol-padding-32 dimasol-pale-green dimasol-col dimasol-half">
        <div class="dimasol-container dimasol-col">
            <form action="/photo/store" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="photoTitle">Nombre de la foto</label>
                <input class="form-control" type="text" name="photoTitle" id="photoTitle" required autofocus/>
                <br/>
                <label for="photoDescription">Descripción</label>
                <input class="form-control" type="textarea" name="photoDescription" id="photoDescription" required/>
                <br/>
                <label for="Photo">Archivo</label>
                <input class="form-control" type="file" name="Photo" id="Photo" required/>
                <br/>
                <input type="hidden" name="album_id" id="album_id" value="{{ $album_id }}">
                <button type="submit" class="btn btn-success">Agregar</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </form>
        </div>
    </div>
</div>
<br>
<a href="/album/admin" class="btn button-radius btn-primary">Regresar a administrar</a>
@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endif
    <a class="btn button-radius btn-link" href="/areas">Regresar</a>
    @endauth
@endsection

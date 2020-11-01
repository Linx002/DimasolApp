@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth
<meta name="csrf-token" value="{{ csrf_token() }}" />
@if (session('msg'))
<div class="dimasol-panel dimasol-blue dimasol-display-container">
    <span onclick="this.parentElement.style.display='none'" class="dimasol-button dimasol-large dimasol-display-topright">&times;</span>
<h3> Información! </h3>
    <p class="msg">{{ session('msg') }}</p>
</div>
@endif
<h1>Administracion de albums</h1>
<div class="dimasol-col dimasol-col-padding dimasol-container dimasol-padding-16">
    <div class="dimasol-container dimasol-padding-32 dimasol-blue-gray dimasol-col dimasol-half">
        <div class="dimasol-container dimasol-col">
            <form action="/album/store" enctype="multipart/form-data" method="POST">
                @csrf
                <h2>Crear álbum</h2>
                <label for="albumName">Nombre del álbum</label>
                <input class="form-control" type="text" name="albumName" id="albumtName" required autofocus/>
                <br/>
                <label for="albumDescription">Descripción</label>
                <input class="form-control" type="textarea" name="albumDescription" id="albumDescription" required/>
                <br/>
                <label for="coverPhoto">Foto de portada</label>
                <input class="form-control" type="file" name="coverPhoto" id="coverPhoto" required/>
                <br/>
                <button type="submit" class="btn btn-success">Crear álbum</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </form>
        </div>
    </div>
    <div class="dimasol-container dimasol-padding-8 dimasol-gray dimasol-col dimasol-half">
        <div class="dimasol-container dimasol-col dimasol-row-padding">
            <table class="dimasol-table">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre del album</th>
                    <th class="dimasol-center" scope="col">Operaciones</th>
                </tr>
                <tr>
                    @foreach($albums as $album)
                <tr>
                    <th scope="row">{{$album->id}}</th>
                    <td><a href="/album/{{$album->id}}" class="dimasol-button dimasol-hover-white">{{$album->albumName}}</a></td>
                    <td>
                        <a href="/photo/add/{{$album->id}}" class="dimasol-button dimasol-hover-white">Agregar fotos</a>
                        <a href="/album/delete/{{$album->id}}" class="dimasol-button dimasol-hover-white">Borrar</a>
                    </td>
                </tr>
                @endforeach
            </table>
            </form>
        </div>
    </div>
</div>
@else
                <h1>
                    Necesita iniciar sesión para ver este contenido.
                </h1>
                    @endauth
                    @endif
@endsection

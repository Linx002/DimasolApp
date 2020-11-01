@extends('layouts.layoutdimasol(blue)')
@section('content')
@if (Route::has('login'))
@auth

@else
<h1>
    Necesita iniciar sesión para ver este contenido.
</h1>
    @endauth
    @endif
@endsection

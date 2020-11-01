@extends('layouts.layoutdimasol(blue)')
@section('content')
<div class="dimasol-row justify-content-center">
            <h2>Registro de usuarios</h2>

        <div class="dimasol-container dimasol-quarter">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                    <label for="name" class="dimasol-col.m4">Nombre</label>
                    <div class="dimasol-col.m6">
                        <input id="name" class="dimasol-input dimasol-border" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                    <label for="email" class="dimasol-col.m4">Correo Electrónico</label>
                    <div class="dimasol-col.m6">
                        <input id="email" class="dimasol-input dimasol-border" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                    <label for="password" class="dimasol-col.m4">Contraseña</label>
                    <div class="dimasol-col.m6">
                        <input class="dimasol-input dimasol-border" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                    <label for="password-confirm" class="dimasol-col.m4">Confirmación de contraseña</label>
                    <div class="dimasol-col.m6">
                        <input id="password-confirm" class="dimasol-input dimasol-border" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <br>
                <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                    <div class="dimasol-col.m6">
                        <button type="submit" class="dimasol-button dimasol-black dimasol-padding-large">Enviar</button>
                    </div>
                </div>
            </form>
    </div>
</div>

@endsection

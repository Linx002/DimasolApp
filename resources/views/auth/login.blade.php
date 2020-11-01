@extends('layouts.layoutdimasol(blue)')
@section('content')
    <div class="dimasol-row justify-content-center">
        <div class="dimasol-col.m8">
            <h2>Iniciar sesión</h2>
            <div class="dimasol-row-padding dimasol-third dimasol-padding-8 dimasol-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                        <label for="email" class="dimasol-col.m6 text-md-right">Correo electrónico</label>

                        <div class="dimasol-col.m6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                        <label for="password" class="dimasol-col.m6 text-md-right">Contraseña</label>

                        <div class="dimasol-col.m6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                        <div class="dimasol-col.m6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">Recordarme en esta página</label>
                            </div>
                        </div>
                    </div>

                    <div class="dimasol-row-padding dimasol-padding-16 dimasol-container">
                        <div class="dimasol-col.m6">
                            <button type="submit" class="dimasol-button dimasol-black dimasol-padding-large">Iniciar sesión</button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

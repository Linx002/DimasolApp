@extends('layouts.layoutdimasol(blue)')

@section('content')
<div class="dimasol-col dimasol-blue">
    <div class="dimasol-third dimasol-container"></div>
    <div class="dimasol-third dimasol-container">
            <h3>@if (session('status'))</h3>
            <div class="dimasol-center alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            {{ __('You are logged in!') }}
    </div>
</div>
<br><br><br>
@include('layouts.lowerbar')
@endsection

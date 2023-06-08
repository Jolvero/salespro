@extends('layouts.app')

@section('content')
<h2>Plantilla de {{Auth::user()->name}}</h2>

<div class="card card-body">
    <p>{{$plantilla->plantilla}}</p>

</div>

@endsection

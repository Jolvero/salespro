@extends('layouts.app')
@section('scripts')
<script src="{{asset('js/recordatorios.js')}}" defer></script>
<script src="{{asset('js/dashboard.js')}}" defer></script>


{{-- <script src="{{asset('js/importacionesDashboard.js')}}"defer></script> --}}
<!-- Inventario -->
{{-- <script src="{{asset('js/inventario.js')}}"defer></script> --}}
@endsection
@section('content')
@include('dashboard.dashboard')
@endsection

@extends('pluranza.main')

@section('content')
    @if(!Auth::user())
        @include('pluranza.academies.register')
    @endif
@stop
@extends('pluranza.main')

@section('content')
    @if(!Auth::user())
        @include('pluranza.academies-participants.register')
    @endif
@stop
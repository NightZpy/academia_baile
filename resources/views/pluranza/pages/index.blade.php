@extends('pluranza.main')

@section('content')
    {{-- Into to public index content --}}
    @include('pluranza.pages.partials._public')
    @role('admin')

    @endrole

    @role('director')

    @else
    @endrole
@stop
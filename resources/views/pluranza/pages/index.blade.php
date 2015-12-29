@extends('pluranza.main')

@section('content')
    @role('admin')

    @endrole

    @role('director')

    @else
        @include('pluranza.pages.partials._public')
    @endrole
@stop
@extends('pluranza.main')

@section('content')
    @include('pluranza.pages.partials._public')
    @role('admin')

    @endrole

    @role('director')

    @else
    @endrole
@stop
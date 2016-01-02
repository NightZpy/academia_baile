@extends('pluranza.main')

@section('content')

    @if (!Auth::check())
        {{-- Into to public index content --}}
        @include('pluranza.pages.partials._public')
    @else
        @role('admin')
            @include('pluranza.admin.index')
        @endrole

        @role('director')
            {{-- Into to public index content --}}
            @include('pluranza.pages.partials._public')
        @endrole
    @endif
@stop
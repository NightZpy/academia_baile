@extends('pluranza.main')

@section('pluranza-fb-scrapping')
    <title>{{ $configuration->title }}</title>
    <meta name="description" content="{{ $configuration->description }}">
    <!-- FACEBOOK TAGS -->
    <meta property="og:title" content="{{ $configuration->title }}" />
    <meta property="og:description" content="{{ $configuration->description }}" />
    <meta property="og:site_name" content="{{ $configuration->long_title }}" />
    <meta property="og:image" content="{{ asset('/assets/images/content/slider/pluranza-facebook.jpg') }}">    
    <meta property="og:image:width" content="1920" />>
    <meta property="og:image:height" content="840" />
@stop

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
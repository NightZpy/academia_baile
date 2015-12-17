@extends('layout.main')

@section('content')
    @include('layout.includes._header')
    <div class="clearfix"></div>
    @include('layout.includes._slider')
    {{-- @include('layout.sections.classes') --}}
    {{--@include('layout.sections.join-us')--}}
    {{--@include('layout.sections.videos')--}}
    {{-- @include('layout.sections.awesome-classes') --}}
    {{--@include('layout.sections.academy-show') --}}{{-- instructors --}}
    {{-- @include('layout.sections.testimonials') --}}
    {{--@include('layout.sections.blog')--}}
    {{--@include('layout.sections.social-networks')--}}
    {{-- @include('layout.sections.contact-us') --}}
    @include('layout.includes._footer')
    {{-- @include('layout.includes._modal-login-form') --}}
@stop
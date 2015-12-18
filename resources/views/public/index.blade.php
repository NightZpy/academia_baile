@extends('public.layout.main')

@section('content')
    @include('public.layout.includes._header')
    <div class="clearfix"></div>
    @include('public.layout.includes._slider')
    {{-- @include('public.layout.sections.classes') --}}
    {{--@include('public.layout.sections.join-us')--}}
    @include('public.layout.sections.videos')
    {{-- @include('public.layout.sections.awesome-classes') --}}
    {{--@include('public.layout.sections.academy-show') --}}{{-- instructors --}}
    {{-- @include('public.layout.sections.testimonials') --}}
    @include('public.layout.sections.blog')
    @include('public.layout.sections.social-networks')
     {{--@include('public.layout.sections.contact-us') --}}
    @include('public.layout.includes._footer')
    {{-- @include('public.layout.includes._modal-login-form') --}}
@stop
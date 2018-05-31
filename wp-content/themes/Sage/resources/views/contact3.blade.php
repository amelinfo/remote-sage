{{--
  Template Name: Contact 3
--}}

@extends('layouts.contact3')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- @include('partials.page-header') --}}
    @include('partials.content-page')
  @endwhile
@endsection
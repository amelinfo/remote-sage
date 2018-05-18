{{--
  Template Name: Contact 1
--}}

@extends('layouts.contact1')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- @include('partials.page-header') --}}
    @include('partials.content-page')
  @endwhile
@endsection
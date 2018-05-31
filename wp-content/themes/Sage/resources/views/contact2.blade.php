{{--
  Template Name: Contact 2
--}}

@extends('layouts.contact2')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- @include('partials.page-header') --}}
    @include('partials.content-page')
  @endwhile
@endsection
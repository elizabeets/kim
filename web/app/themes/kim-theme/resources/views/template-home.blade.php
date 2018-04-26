{{--
  Template Name: Home Page Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  @include('partials.home.hero')
  @include('partials.home.about')
  @include('partials.home.logos')
  @include('partials.home.featured')
  @include('partials.home.instagram')
  @include('partials.home.newsletter')
  @endwhile
@endsection

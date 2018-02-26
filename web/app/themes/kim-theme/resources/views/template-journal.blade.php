{{--
  Template Name: Journal Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        {!! get_field('gallery') !!}
      </div>
    </div>
  </div>
  @endwhile
@endsection

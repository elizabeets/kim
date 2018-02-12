@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        @include('partials.page-header')
      </div>
    </div>
    <div class="row">
      <div class="col">
        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif

        @while (have_posts()) @php(the_post())
        @include('partials.content-'.get_post_type())
        @endwhile
      </div>
    </div>
    <div class="row">
      <div class="col">
        {!! get_the_posts_navigation() !!}
      </div>
    </div>
  </div>
@endsection

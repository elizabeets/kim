@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  <div class="container">
    <div class="row">
      <div class="col">
        @include('partials.page-header')
        @include('partials.content-page')
      </div>
    </div>
  </div>
  @endwhile
@endsection

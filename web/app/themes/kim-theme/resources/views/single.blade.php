@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        @while(have_posts()) @php(the_post())
        @include('partials.content-single-'.get_post_type())
        @endwhile
      </div>
    </div>
  </div>
@endsection

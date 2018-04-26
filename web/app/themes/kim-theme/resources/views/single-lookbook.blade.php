@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        @while(have_posts()) @php(the_post())
        <div class="container-fluid">
          <div class="row">
            <div class="col text-left">
              <h2>{!! get_the_title() !!}</h2>
              {!! get_field('description') !!}
            </div>
          </div>
          <div class="row">
            <div class="col">
              {!! get_field('gallery') !!}
            </div>
          </div>
        </div>
        @endwhile
      </div>
    </div>
  </div>
@endsection

{{--
  Template Name: Lookbooks Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  @php($lookbooks = get_field('lookbooks'))
  @if(!$lookbooks)
    <h2>Sorry, no lookbooks available at the moment.</h2>
  @else
    @foreach($lookbooks as $lookbook)
      <article class="lookbook">
        <div class="container">
          <div class="lookbook-front row">
            <div class="info col-12 col-md-4 text-left text-md-right order-last order-md-first">
              <h2>{!! $lookbook['title'] !!}</h2>
              {!! $lookbook['description'] !!}
              <button>Show more</button>
            </div>
            <div class="image col-12 col-md-8 text-left order-first order-md-last">
              <div class="image-container">
                <img src="{{ $lookbook['cover_image']['url'] }}"/>
              </div>
            </div>
          </div>
          <div class="lookbook-back row">
            <div class="col">
              <div class="container-fluid">
                <div class="row">
                  <div class="col text-left">
                    <h2>{!! $lookbook['title'] !!}</h2>
                  </div>
                  <div class="col text-right">
                    <strong class="flip-lookbook">X</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    {!! $lookbook['gallery'] !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    @endforeach
  @endif
  @endwhile
@endsection

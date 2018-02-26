{{--
  Template Name: Bio Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <section class="bio-content">
          {!! get_field('bio_content') !!}
        </section>
      </div>
      <div class="col-6">
        <section class="slider">
          @foreach(get_field('slider') as $slide)
            <div class="slide" style="background-image: url({{ $slide['url'] }})"></div>
          @endforeach
        </section>
      </div>
    </div>
  </div>
  @endwhile
@endsection

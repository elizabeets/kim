{{--
  Template Name: Coming Soon Template
--}}

@extends('layouts.app')

@section('content')
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center splash">
        <div class="site-logo">
          <img src="{{ App\get_site_logo() }}" alt="{{ get_bloginfo('name') }}"/>
        </div>

        <div class="info">
          <h3>Coming Soon</h3>
          <p>We're excited to be part of your world soon!
            <br/>
            Feel free to contact me via the channels below</p>
            @include('partials.common.social-icons')
        </div>

      </div>
    </div>
  </div>
  </div>
  {{--@while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile--}}
@endsection

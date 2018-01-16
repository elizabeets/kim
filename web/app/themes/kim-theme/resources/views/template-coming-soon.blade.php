{{--
  Template Name: Coming Soon Template
--}}

@extends('layouts.app')

@section('content')
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
          @if(get_field('social_networks', 'option'))
            @if(have_rows('social_networks', 'option'))
              <ul class="social-icons list-unstyled list-inline">
                @while (have_rows('social_networks', 'option')) @php(the_row())
                <li class="icon list-inline-item text-center">
                  <a href="{{ get_sub_field('url') }}" class="network" target="new"
                     title="Follow us on {{ get_sub_field('name') }}">
                    <i class="{{ get_sub_field('icon') }}"></i>
                  </a>
                </li>
                @endwhile
              </ul>
            @endif
          @endif
        </div>

      </div>
    </div>
  </div>
  </div>
  {{--@while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile--}}
@endsection

@include('partials.mobile-menu')
<!-- Header -->
<header class="banner">
  <div class="container-fluid">

    <div class="row">

      <div class="col-3 text-center">
        <a class="brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
          @php($site_logo = App\get_site_logo())
          @if($site_logo)
            <img class="site-logo" src="{{ $site_logo }}"
                 alt="{{ get_bloginfo('name', 'display') }}"/>
          @else
            <h4>{{ get_bloginfo('name', 'display') }}</h4>
          @endif
        </a>
      </div>

      @if(wp_is_mobile() === false)
        <div class="col-6">
          <nav class="nav-primary hidden-md-down text-center">
            @if(!is_user_logged_in())
              @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
              @endif
            @else
              @if (has_nav_menu('user_logged_in_nav'))
                {!! wp_nav_menu(['theme_location' => 'user_logged_in_nav', 'menu_class' => 'nav']) !!}
              @else
                {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
              @endif
            @endif
          </nav>
        </div>
      @endif

      <div class="col-3">
        @include('partials.action-menu')
      </div>
    </div>

  </div>
</header>
<!-- // Header -->

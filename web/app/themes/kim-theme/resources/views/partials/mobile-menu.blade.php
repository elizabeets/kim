<!-- Overlay Menu -->
@if(wp_is_mobile())
  <div id="hamburger" class="hamburglar">

    <div class="burger-icon">
      <div class="burger-container">
        <span class="burger-bun-top"></span>
        <span class="burger-filling"></span>
        <span class="burger-bun-bot"></span>
      </div>
    </div>

    <!-- svg ring containter -->
    <div class="burger-ring">
      <svg class="svg-ring">
        <path class="path" fill="none" stroke="#304249" stroke-miterlimit="10" stroke-width="4"
              d="M 34 2 C 16.3 2 2 16.3 2 34 s 14.3 32 32 32 s 32 -14.3 32 -32 S 51.7 2 34 2"/>
      </svg>
    </div>
    <!-- the masked path that animates the fill to the ring -->

    <svg width="0" height="0">
      <mask id="mask">
        <path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ff0000" stroke-miterlimit="10" stroke-width="4"
              d="M 34 2 c 11.6 0 21.8 6.2 27.4 15.5 c 2.9 4.8 5 16.5 -9.4 16.5 h -4"/>
      </mask>
    </svg>
    <div class="path-burger">
      <div class="animate-path">
        <div class="path-rotation"></div>
      </div>
    </div>

  </div>

  <div class="mobile-menu-overlay">
    <nav>
      @if(!is_user_logged_in())
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation']) !!}
        @endif
      @else
        @if (has_nav_menu('user_logged_in_nav'))
          {!! wp_nav_menu(['theme_location' => 'user_logged_in_nav']) !!}
        @else
          {!! wp_nav_menu(['theme_location' => 'primary_navigation']) !!}
        @endif
      @endif
    </nav>
  </div>
@endif
<!-- // Overlay Menu -->

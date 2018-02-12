<!-- Overlay Menu -->
@if(wp_is_mobile())
    <i id="trigger-overlay" class="mobile-menu-icon"></i>

    <div class="overlay overlay-hugeinc">
        <i id="overlay-close" class="mobile-menu-icon"></i>
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
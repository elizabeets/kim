<ul class="action-menu float">
  <li>
    <a href="#" class="btn btn-sm">
      <i class="fas fa-search fa-2x"></i>
    </a>
  </li>
  <li>
    <a href="{{ wc_get_page_permalink('cart') }}" class="btn btn-sm" title="My Cart">
      {{--            <span>{!! WC()->cart->get_cart_contents_count() !!} ({!! App\get_wc_cart_total() !!})</span>--}}
      <i class="fas fa-shopping-cart fa-2x"></i>
    </a>
  @if(is_user_logged_in())
    <li>
      <a href="{{ wc_get_page_permalink('myaccount') }}" class="btn btn-sm" title="My Account">
        <i class="fas fa-user fa-2x"></i>
      </a>
    </li>
    <li>
      <a href="{{ wp_logout_url('/') }}" class="btn btn-sm" title="Sign Out">
        <i class="fas fa-sign-out-alt fa-2x"></i>
      </a>
    </li>
  @else
    <li>
      <a href="{{ wp_login_url('/') }}" class="btn btn-sm" title="Sign In">
        <i class="fas fa-sign-in-alt fa-2x"></i>
      </a>
    </li>
  @endif
</ul>

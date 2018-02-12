<footer class="layout">
  <div class="container-fluid">
    <div class="row justify-content-between">
      <div class="col">
        @include('partials.common.social-icons')
      </div>
      <div class="col">
        {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav text-right float-right']) !!}
      </div>
    </div>
  </div>
</footer>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      @php(the_content())
    </div>
  </div>
  <div class="row">
    <div class="col">
      {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </div>
  </div>
</div>

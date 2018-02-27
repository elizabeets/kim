<section class="newsletter">
  <div class="container text-center">
    <div class="row">
      <div class="col-12">
        <h3>{!! get_field('newsletter_section_heading', 'option') !!}</h3>
      </div>
    </div>
    <div class="row">
      <div class="col">
        {!! do_shortcode(get_field('newsletter_form_shortcode', 'option')) !!}
      </div>
    </div>
  </div>
</section>

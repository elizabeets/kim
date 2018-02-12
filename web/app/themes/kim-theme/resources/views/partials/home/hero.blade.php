<section class="hero">
  <div class="hero-slider">
    @foreach(get_field('hero_slider') as $slide)
      @if(wp_is_mobile())
        @if($slide['image']['mobile'])
          @php($slide_image = $slide['image']['mobile']['sizes']['large'])
        @else
          @php($slide_image = $slide['image']['desktop']['sizes']['large'])
        @endif
      @else
        @php($slide_image = $slide['image']['desktop']['sizes']['large'])
      @endif
      @if($slide['button']['url'])
        <a href="{{ $slide['button']['url'] }}" target="new">
          <div class="hero-slide" style="background-image: url({{ $slide_image }})"></div>
        </a>
      @else
        <div class="hero-slide" style="background-image: url({{ $slide_image }})"></div>
      @endif
    @endforeach
  </div>
</section>

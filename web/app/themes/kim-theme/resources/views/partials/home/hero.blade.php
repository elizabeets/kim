<section class="hero">
  <div class="hero-slider">
    @foreach(get_field('hero_slider') as $slide)
      @if(wp_is_mobile())
        @if($slide['image']['mobile'])
          @php($slide_url = $slide['image']['mobile']['url'])
        @else
          @php($slide_url = $slide['image']['desktop']['url'])
        @endif
      @else
        @php($slide_url = $slide['image']['desktop']['url'])
      @endif
      @if($slide['button']['url'])
        <a href="{{ $slide['button']['url'] }}" target="new">
          <div class="hero-slide" style="background-image: url({{ $slide_url }})"></div>
        </a>
      @else
        <div class="hero-slide" style="background-image: url({{ $slide_url }})"></div>
      @endif
    @endforeach
  </div>
</section>

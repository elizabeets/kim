@if(get_field('featured_grid'))
  <section class="featured">

    <div class="container">
      @php($i = 1)
      @foreach(get_field('featured_grid') as $item)
        @php($url = $item['url']['is_external'] ? $item['url']['external_url'] : get_permalink($item['url']['internal_url'][0]->ID))
        @php($image_url = wp_is_mobile() ? $item['image']['mobile']['sizes']['large'] : $item['image']['desktop']['sizes']['large'])
        @if($i === 1)
          <div class="row"> @endif
            <div class="col-12 col-md">
              <a href="{{ $url }}" @if($item['url']['new_window']) target="new" @endif>
                <article
                  @php(post_class('text-center')) style="background-image:url({{ $image_url }})">
                  <div class="overlay"></div>
                  <header>
                    <h2 class="entry-title">
                      {{ $item['title'] }}
                    </h2>
                  </header>
                </article>
              </a>
            </div>
            @if($i === 2)
              @php($i = 1)
          </div>
        @else
          @php($i++)
        @endif
      @endforeach
    </div>

  </section>

@endif

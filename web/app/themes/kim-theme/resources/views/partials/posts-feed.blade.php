<!-- Posts Feed -->
<div class="container post-feed">
  <div class="row">
    @php($i = 1)
    @while (have_posts()) @php(the_post())

    @php($words_count = $i == 1 ? 18 : 13)

    @php($post_width = App\get_post_width($i))
    @php($post_featured = $i == 1 ? ' featured' : '')

    @if($i == 1) @php($thumb_size = 'large') @endif
    @if($i > 1) @php($thumb_size = 'medium') @endif

    <div class="{{ $post_width }} d-flex flex-nowrap">
      <article class="d-flex post{{ $post_featured }}">
        <a class="post-link" href="{{ get_permalink() }}">
          @if(get_the_post_thumbnail_url())
            <div class="post-thumb">
              <img src="{{ get_the_post_thumbnail_url() }}" alt="{{ the_title() }}"/>
            </div>
          @else
            <div class="post-thumb">
              <img src="{{ wp_get_attachment_image_url(get_field('default_post_image', 'option'), 'large') }}"
                   alt="{{ the_title() }}"/>
            </div>
          @endif

          <div class="post-meta">
            <div class="post-title align-self-center">
              @if(is_front_page() && $i == 1)
                <h1>{{ get_the_title() }}</h1>
              @else
                <h2>{{ get_the_title() }}</h2>
              @endif
            </div>
          </div>

        </a>
      </article>
    </div>
    @php($i++)

    @endwhile
  </div>
</div>
<!-- // Posts Feed -->

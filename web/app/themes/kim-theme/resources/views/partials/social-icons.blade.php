@if(get_field('social_networks', 'option'))
  @if(have_rows('social_networks', 'option'))
    <ul class="social-icons list-unstyled list-inline">
      @while (have_rows('networks', 'option')) @php(the_row())
      <li class="icon list-inline-item text-center">
        <a href="{{ get_sub_field('url') }}" class="network" target="new"
           title="Follow us on {{ get_sub_field('name') }}">
          <i class="fab fa-{{ get_sub_field('icon') }}"></i>
        </a>
      </li>
      @endwhile
    </ul>
  @endif
@endif

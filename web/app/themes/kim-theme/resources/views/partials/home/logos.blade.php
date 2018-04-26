@php($logos = get_field('logo_row'))
@if($logos)
  <section class="logos">
    <div class="container">
      <div class="row align-items-center text-center">
        @foreach($logos as $logo)
          <div class="col logo">
            <a href="{{ $logo['link']['is_external'] ? $logo['link']['url'] : $logo['link']['page'] }}"
               @if($logo['link']['new_window']) target="_blank" @endif>
              <img src="{{ $logo['logo']['url'] }}" alt="{{ $logo['title'] }}"/>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endif

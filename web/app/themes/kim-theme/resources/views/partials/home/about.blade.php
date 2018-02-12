@php($about = get_field('about'))
@if($about)
  <section class="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-12">
          @if($about['title'])
            <h3>{{ $about['title'] }}</h3>
          @endif
          {!! $about['content'] !!}
        </div>
      </div>
    </div>
  </section>
@endif

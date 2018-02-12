`@if(get_field( 'partners_logo_bar', 'option' ))
    @if(have_rows( 'partners_logo_bar', 'option' ))
        <div class="partners">
            <div class="logo-bar">
                <div class="container text-center">

                    @if(get_field('partners_title', 'option'))
                        <div class="row">
                            <div class="col">
                                <h6>{{ the_field('partners_title', 'option') }}</h6>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        @while ( have_rows( 'partners_logo_bar', 'option' ) ) @php(the_row())
                        <div class="col">
                            <div class="logo">
                                @if(get_sub_field('url'))
                                    <div class="img-container">
                                        <a href="{{ get_sub_field('url') }}" target="new"
                                           title="{{ get_sub_field('name') }}">
                                            <img src="{{ get_sub_field('image') }}" alt="{{ get_sub_field('name') }}"/>
                                        </a>
                                    </div>
                                @else
                                    <div class="img-container">
                                        <img src="{{ get_sub_field('image') }}" alt="{{ get_sub_field('name') }}"/>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endwhile
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

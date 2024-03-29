<!doctype html>
<!--
    :::    ::: ::::::::::: ::::    ::::       :::    ::: :::::::::: :::   ::: ::::    ::::      :::     ::::    :::
    :+:   :+:      :+:     +:+:+: :+:+:+      :+:    :+: :+:        :+:   :+: +:+:+: :+:+:+   :+: :+:   :+:+:   :+:
    +:+  +:+       +:+     +:+ +:+:+ +:+      +:+    +:+ +:+         +:+ +:+  +:+ +:+:+ +:+  +:+   +:+  :+:+:+  +:+
    +#++:++        +#+     +#+  +:+  +#+      +#++:++#++ +#++:++#     +#++:   +#+  +:+  +#+ +#++:++#++: +#+ +:+ +#+
    +#+  +#+       +#+     +#+       +#+      +#+    +#+ +#+           +#+    +#+       +#+ +#+     +#+ +#+  +#+#+#
    #+#   #+#      #+#     #+#       #+#      #+#    #+# #+#           #+#    #+#       #+# #+#     #+# #+#   #+#+#
    ###    ### ########### ###       ###      ###    ### ##########    ###    ###       ### ###     ### ###    ####
-->
<html @php(language_attributes())>
@include('partials.head')
<body @php(body_class('animated fadeIn'))>
@if(get_field('body_scripts', 'options'))
  {!! get_field('body_scripts', 'options') !!}
@endif
@php(do_action('get_header'))
@include('partials.header')
<div class="wrap" role="document">
  <div class="content">
    <main class="main">
      @yield('content')
    </main>
  </div>
</div>
@php(do_action('get_footer'))
@include('partials.footer')
@php(wp_footer())
@if(get_field('footer_scripts', 'options'))
  {!! get_field('footer_scripts', 'options') !!}
@endif
</body>
</html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php(wp_head())
  @if(get_field('head_scripts', 'options'))
    {!! get_field('head_scripts', 'options') !!}
  @endif
</head>

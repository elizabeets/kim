@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @php(woocommerce_content())
            </div>
        </div>
    </div>
@endsection
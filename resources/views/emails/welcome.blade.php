@extends('dashboard.layouts.master')

@push('styles')
    <style>
        .signature {
            text-align: left; /* Align text to the left */
        }

        .signature img {
            margin-bottom: 5px; /* Adjust the space between image and text */
        }
    </style>
@endpush
@section('content')
    <div class="email-container">
        <header class="row">
            <div class="col-md-12 col-sm-12 d-flex justify-content-start">
                <div class="signature d-flex flex-column align-items-start">
                    <img class="img-fluid w-50 mb-2" src="{{ asset($settings['logo']) }}" alt="Logo">
                    <h5 class="d-block text-primary">{{ $settings['name'] }}</h5>
                </div>
            </div>
        </header>
        <main class="row d-flex justify-content-center text-start my-5">
            <div class="col-md-8">
                <h1 class="text-primary">{{ __('dashboard.Welcome to') }}, {{ $user->name }}!</h1>
                <p class=""> {!! $body !!} <a class="text-primary" href="{{$register_route}}">
                        من هنا </a></p>
            </div>
        </main>
        <footer class="row text-center mt-5">
            <div class="col-md-12">
                {!! $footer !!}
            </div>
        </footer>
    </div>

@endsection

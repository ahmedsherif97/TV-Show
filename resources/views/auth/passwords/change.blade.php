@extends('dashboard.layouts.master')

@push('styles')
    <style>
        .error {
            border-color: red;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('main.change_password') }}</div>

                    <div class="card-body">
                        <form id="changePassForm" method="POST" action="{{ route('admin.password.doChange') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('main.new_password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirmation"
                                    class="col-md-4 col-form-label text-md-end">{{ __('main.password_confirmation') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirmation" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <x-dashboard.forms.save />

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

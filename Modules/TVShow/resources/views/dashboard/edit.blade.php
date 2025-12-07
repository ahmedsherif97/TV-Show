@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.show.index')">
            {{ __('tvshow::dashboard.t_v_shows') }}
        </x-dashboard.breadcrumbs-item>
        <x-dashboard.breadcrumbs-item :href="route('dashboard.show.index')">
            {{ $tvshow->title }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $tvshow->title }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.show.update', $tvshow->id) }}">
                @csrf
                @method('PUT')
                @includeIf('tvshow::dashboard.form')
                <x-dashboard.forms.save/>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
            <div class="additional-btns">
                @can('create episode')
                    <a class="btn btn-primary" href="{{ route('dashboard.episode.create') }}">
                        <span class="bx bx-plus"></span>
                        {{ __('episode::dashboard.create') }} {{ __('episode::dashboard.episode') }}
                    </a>
                @endcan
            </div>
        </div>

        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top table-striped table-hover"
                   data-href="{{ route('dashboard.episode.datatable') }}">
                <thead>
                <tr>
                    <th data-column="id" data-searchable="false"></th>
                    <th data-column="title" data-searchable="true" data-orderable="true">
                        {{ __('dashboard.title') }}
                    </th>
                    <th data-column="tv_show" data-searchable="false" data-orderable="false">
                        {{ __('tvshow::dashboard.tvshow') }}
                    </th>
                    <th data-column="airing_at" data-searchable="false" data-orderable="true">
                        {{ __('episode::dashboard.airing_at') }}
                    </th>
                    <th data-column="duration" data-searchable="false" data-orderable="false">
                        {{ __('episode::dashboard.duration') }}
                    </th>
                    <th data-column="video" data-searchable="false" data-orderable="false">
                        {{ __('episode::dashboard.video') }}
                    </th>
                    <th data-column="actions" data-searchable="false" data-orderable="false">
                        {{ __('dashboard.actions') }}
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

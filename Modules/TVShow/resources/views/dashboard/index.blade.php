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
                @can('create t_v_show')
                    <a class="btn btn-primary" href="{{ route('dashboard.show.create') }}">
                        <span class="bx bx-plus"></span>
                        {{ __('tvshow::dashboard.create') }} {{ __('tvshow::dashboard.a tvshow') }}
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top table-striped table-hover"
                   data-href="{{ route('dashboard.show.datatable') }}">
                <thead>
                <tr>
                    <th data-column="id" data-searchable="false"></th>
                    <th data-column="title" data-searchable="true" data-orderable="true">{{ __('dashboard.title') }}</th>
                    <th data-column="slug">{{ __('dashboard.slug') }}</th>
                    <th data-column="schedule">Show Time</th>
                    <th data-column="is_active">{{ __('dashboard.status') }}</th>
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

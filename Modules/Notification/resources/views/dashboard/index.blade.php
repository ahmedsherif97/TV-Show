@extends('dashboard.layouts.master')

@push('styles')
@endpush
@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item>
            ملف المستخدم
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-2">
                {{--                <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>--}}

            </div>
        </div>

        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table class="datatables-basic table border-top table-hover" search="true"
                       data-href="{{route('dashboard.notification.datatable')}}">
                    <thead>
                    <tr>
                        <th data-column="id" data-searchable="false"
                            data-orderable="false">{{ __('meeting::dashboard.id') }}</th>
                        <th data-column="type" data-orderable="false"
                            class="text-center">{{ __('dashboard.type') }}</th>
                        <th data-column="data" data-orderable="false" class="text-center">التفاصيل</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

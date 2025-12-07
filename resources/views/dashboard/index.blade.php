@extends('dashboard.layouts.master')

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
    </x-dashboard.breadcrumbs>
@endpush
@section('content')

@endsection

@push('scripts')
@endpush

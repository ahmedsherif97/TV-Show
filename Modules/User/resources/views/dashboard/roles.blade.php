@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.user.index')">
            {{ __('user::dashboard.users') }}
        </x-dashboard.breadcrumbs-item>
        <x-dashboard.breadcrumbs-item :href="route('dashboard.user.index')">
            {{ $user->name }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title ?? '' }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('dashboard/user/'.$user->id.'/roles') }}">
                @csrf
                <select name="roles[]" id="roles" class="form-control form-select select2" multiple required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ in_array($user->id, $role->users()->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                <x-dashboard.forms.save/>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

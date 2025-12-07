@extends('dashboard.layouts.master')

@push('styles')
@endpush
@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.role.index')">
            {{ __('role::dashboard.roles') }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('permission::dashboard.permissions') ?? '' }}</h5>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <form method="post" action="{{ route('dashboard.role.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <x-dashboard.forms.input id="name" type="text" label="{{ __('dashboard.name') }}"
                                                         name="name"
                                                         value="{{ old('name', $role->name ?? '') }}"
                                                         placeholder="{{ __('dashboard.Enter') . ' ' . __('dashboard.name') }}"
                                                         required="true"/>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-12">
                                <label class="new-control new-checkbox new-checkbox-text checkbox-success mx-3 pb-2">
                                    <input type="checkbox" class="new-control-input check-all">
                                    <span class="new-control-indicator"></span><span
                                            class="new-chk-content">{{ __('dashboard.select all') }}</span>
                                </label>
                            </div>

                            @foreach($groupedPermissions as $group => $permissions)
                                <div class="widget-content widget-content-area">
                                    <div class="card component-card_2 col-md-12 px-0">
                                        <div class="form-group h-50 mb-0 px-3 pt-2"
                                             style="background-color: #0072ff42;">
                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                <input type="checkbox"
                                                       class="new-control-input check-all-group check-all-{{ $group }}">
                                                <span class="new-control-indicator"></span><span
                                                        class="new-chk-content text-primary"><b>{{ ucfirst($group) }}</b></span>
                                            </label>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($permissions as $permission)
                                                    <div class="n-chk col-md-3 form-row">
                                                        <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                            <input type="checkbox"
                                                                   name="permissions[{{ $permission->id }}]"
                                                                   class="new-control-input perm-check perm-check-{{ $group }}"
                                                                    {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                            <span class="new-control-indicator"></span><span
                                                                    class="new-chk-content"><b>{{ $permission->name }}</b></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <button type="submit" class="btn btn-primary mt-3">{{ __('dashboard.update') }}</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('input[name="name"]').prop('disabled', true)

            function updateSelectAllCheckbox() {
                let allBoxes = $("input.perm-check");
                let allChecked = allBoxes.length === allBoxes.filter(":checked").length;
                $(".check-all").prop('checked', allChecked);
            }

            function updateGroupCheckbox(group) {
                let groupBoxes = $(`.perm-check-${group}`);
                let groupChecked = groupBoxes.length === groupBoxes.filter(":checked").length;
                $(`.check-all-${group}`).prop('checked', groupChecked);
            }

            // Initial state update on page load
            updateSelectAllCheckbox();
            @foreach($groupedPermissions as $group => $permissions)
            updateGroupCheckbox('{{ $group }}');
            @endforeach

            // Event handler for individual checkboxes
            $(document).on('change', 'input.perm-check', function () {
                updateSelectAllCheckbox();

                let group = $(this).attr('class').split(' ').find(cls => cls.startsWith('perm-check-')).split('-')[2];
                updateGroupCheckbox(group);
            });

            // Event handler for "Select All" checkbox
            $(".check-all").click(function () {
                let checked = this.checked;
                $('input.perm-check').prop('checked', checked);

                @foreach($groupedPermissions as $group => $permissions)
                $(`.check-all-{{ $group }}`).prop('checked', checked);
                @endforeach
            });

            // Event handler for group checkboxes
            @foreach($groupedPermissions as $group => $permissions)
            $(".check-all-{{ $group }}").click(function () {
                let checked = this.checked;
                $(`input.perm-check-{{ $group }}`).prop('checked', checked);

                updateSelectAllCheckbox();
            });
            @endforeach
        });
    </script>
@endpush

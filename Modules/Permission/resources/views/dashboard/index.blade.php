@extends('dashboard.layouts.master')

@push('styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Search Filter</h5>

        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top table-striped table-hover">
                <thead>
                    <tr>
                        <th data-column="id"></th>
                        <th data-column="name">Name</th>
                        <th data-column="roles">Roles</th>
                        <th data-column="actions">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            const table = $('.datatables-users')
            let tableColumns = [];
            table.find('thead tr th').each(function() {
                tableColumns.push({
                    data: $(this).data('column')
                });
            });

            table.DataTable({
                "searchDelay": 1000,
                "searchable": false,
                "processing": true,
                "serverSide": true,
                "ajax": "",
                "ajax": {
                    "url": "{{ route('dashboard.permission.datatable') }}",
                    "type": "GET",
                },
                "buttons": [...dataTableButtons, [
                    //here rou can add more buttons
                ]],
                columns: tableColumns
            });
        });
    </script>
@endpush

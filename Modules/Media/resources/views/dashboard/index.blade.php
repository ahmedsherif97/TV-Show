@extends('dashboard.layouts.master')

@push('styles')
  //
@endpush

@section('content')
      <!-- Users List Table -->
      <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title">Search Filter</h5>
          <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
          </div>
        </div>
        <div class="card-datatable table-responsive">
          <table class="datatables-users table border-top">
            <thead>
              <tr>
                <th></th>
                <th>User</th>
                <th>Role</th>
                <th>Plan</th>
                <th>Billing</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.datatables-users').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('dashboard.media.datatable') }}",
            });
        });
    </script>
@endpush

@props([
    'alerts' => ['success', 'error', 'warning', 'info', 'danger'],
])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($alerts as $type)
            @if (Session::has('alert-' . $type))
                toastr["{{ $type }}"]("{{ Session::get('alert-' . $type) }}", "");
            @endif
        @endforeach
    });
</script>

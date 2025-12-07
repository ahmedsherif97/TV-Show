@extends('dashboard.layouts.master')

@push('styles')
@endpush

@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
        <x-dashboard.breadcrumbs-item :href="route('dashboard.episode.index')">
            {{ __('episode::dashboard.episodes') }}
        </x-dashboard.breadcrumbs-item>
        <x-dashboard.breadcrumbs-item :href="route('dashboard.episode.index')">
            {{ $episode->tvShow->title ?? '' }}
        </x-dashboard.breadcrumbs-item>
        <x-dashboard.breadcrumbs-item :href="route('dashboard.episode.index')">
            {{ $episode->title }}
        </x-dashboard.breadcrumbs-item>
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    @php
        $videoUrl = $episode->getFirstMediaUrl('video');
        $durationSeconds = $episode->duration_seconds ?? 0;
        $durationLabel = $durationSeconds > 0 ? gmdate('H:i:s', $durationSeconds) : '-';
    @endphp

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title ?? __('episode::dashboard.video') }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('dashboard.episode.video.upload', $episode->id) }}"
                  class="dropzone border border-primary rounded-2 dz-clickable"
                  id="episode-video-upload-form"
                  enctype="multipart/form-data">
                @csrf
                <div class="dz-message text-center py-5" data-dz-message>
                    <span class="text-muted">
                        {{ __('episode::dashboard.drop_or_click_video') }}
                    </span>
                </div>
            </form>

            <div class="row mt-4" id="episode-video-container">
                @if($videoUrl)
                    <div class="col-md-8 mb-3 video-card" data-id="{{ $episode->id }}">
                        <div class="card h-100">
                            <video id="episode-video-player" class="w-100 rounded-top" height="320" controls>
                                <source src="{{ $videoUrl }}" type="video/mp4">
                                {{ __('episode::dashboard.video_not_supported') }}
                            </video>
                            <div class="card-body text-center">
                                <h6 class="card-title text-truncate mb-2">
                                    {{ $episode->title }}
                                </h6>
                                <p class="mb-2">
                                    {{ __('episode::dashboard.duration') }}:
                                    <strong id="episode-duration-label"
                                            data-initial-seconds="{{ $durationSeconds }}">
                                        {{ $durationLabel }}
                                    </strong>
                                </p>
                                <button class="btn btn-outline-danger btn-sm delete-video" data-id="{{ $episode->id }}">
                                    {{ __('episode::dashboard.delete_video') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-muted text-center w-100 mt-3">
                        {{ __('episode::dashboard.no_video') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <style>
        #episode-video-upload-form {
            background-color: #f8f9fa;
            min-height: 150px;
        }

        #episode-video-upload-form.dz-drag-hover {
            background-color: #e3f2fd;
            border-color: #2196f3;
        }

        .dz-message {
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Dropzone.autoDiscover = false;

        new Dropzone("#episode-video-upload-form", {
            url: "{{ route('dashboard.episode.video.upload', $episode->id) }}",
            maxFilesize: 1024,
            acceptedFiles: "video/mp4",
            chunking: true,
            forceChunking: true,
            chunkSize: 2 * 1024 * 1024,
            parallelChunkUploads: false,
            retryChunks: true,
            addRemoveLinks: true,
            timeout: 3600000,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            init: function () {
                var uploadedFiles = {};
                this.on("success", function (file, response) {
                    if (!uploadedFiles[file.name]) {
                        uploadedFiles[file.name] = true;
                        Swal.fire({
                            icon: "success",
                            title: "{{ __('episode::dashboard.upload_success_title') }}",
                            text: "{{ __('episode::dashboard.upload_success_text') }}",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        this.removeFile(file);
                        window.location.reload();
                    }
                });
                this.on("error", function (file, errorMessage, xhr) {
                    var message = xhr ? xhr.responseText : errorMessage;
                    Swal.fire({
                        icon: "error",
                        title: "{{ __('episode::dashboard.upload_error_title') }}",
                        text: message
                    });
                });
            }
        });

        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("delete-video")) {
                var episodeId = e.target.getAttribute("data-id");
                var videoCard = e.target.closest(".video-card");

                Swal.fire({
                    title: "{{ __('episode::dashboard.delete_confirm_title') }}",
                    text: "{{ __('episode::dashboard.delete_confirm_text') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "{{ __('episode::dashboard.delete_confirm_yes') }}",
                    cancelButtonText: "{{ __('episode::dashboard.delete_confirm_cancel') }}"
                }).then(function (result) {
                    if (result.isConfirmed) {
                        deleteEpisodeVideo(episodeId, videoCard);
                    }
                });
            }
        });

        function deleteEpisodeVideo(episodeId, videoCard) {
            var url = "{{ route('dashboard.episode.video.delete', ':id') }}".replace(":id", episodeId);

            fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                }
            }).then(function (response) {
                if (response.ok) {
                    if (videoCard) {
                        videoCard.remove();
                    }
                    Swal.fire("{{ __('episode::dashboard.deleted_title') }}", "{{ __('episode::dashboard.deleted_text') }}", "success");
                } else {
                    Swal.fire("{{ __('episode::dashboard.delete_error_title') }}", "{{ __('episode::dashboard.delete_error_text') }}", "error");
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var video = document.getElementById("episode-video-player");
            var durationLabel = document.getElementById("episode-duration-label");
            if (!video || !durationLabel) return;

            var initialSeconds = parseInt(durationLabel.getAttribute("data-initial-seconds") || "0", 10);
            if (!isNaN(initialSeconds) && initialSeconds > 0) return;

            function updateDuration() {
                var seconds = Math.floor(video.duration || 0);
                if (!seconds || seconds <= 0) return;

                var url = "{{ route('dashboard.episode.video.duration', ':id') }}"
                    .replace(":id", "{{ $episode->id }}");

                fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({duration: seconds})
                }).then(function (response) {
                    if (!response.ok) return;

                    var h = Math.floor(seconds / 3600);
                    var m = Math.floor((seconds % 3600) / 60);
                    var s = seconds % 60;

                    var parts = [];
                    if (h > 0) parts.push(String(h).padStart(2, "0"));
                    parts.push(String(m).padStart(2, "0"));
                    parts.push(String(s).padStart(2, "0"));

                    durationLabel.textContent = parts.join(":");
                    durationLabel.setAttribute("data-initial-seconds", String(seconds));
                });
            }

            if (video.readyState >= 1) {
                updateDuration();
            } else {
                video.addEventListener("loadedmetadata", updateDuration);
            }
        });
    </script>

@endpush

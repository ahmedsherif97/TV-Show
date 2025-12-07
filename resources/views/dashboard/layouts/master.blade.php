<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="light-style layout-compact layout-menu-fixed layout-navbar-hidden"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @stack('meta')

    <title>Dashboard | TV Show</title>

    <meta name="description" content="" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/core.css"
            class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/theme-default.css?v=19"
            class="template-customizer-theme-css" />
    @else
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css?v=19"
            class="template-customizer-theme-css" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css?v=35" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/select2/select2.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ asset('assets') }}/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/spinkit/spinkit.css" />
    <style>
        .btn .bx {
            line-height: 1.25;
        }

        div.dataTables_wrapper div.dataTables_length {
            margin-top: 0rem !important;
            margin-bottom: 0rem !important;
        }

        div.dataTables_wrapper div.dataTables_filter {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }


        .dt-action-buttons .dt-buttons {
            margin-bottom: 12px;
            /* This is equivalent to mb-3 in Bootstrap */
            margin-top: 12px;
            /* This is equivalent to mb-3 in Bootstrap */
        }

        .dataTables_wrapper .dropdown-item {
            line-height: 1.2;
        }

        div.dataTables_wrapper {
            position: unset;
        }

        .layout-menu-collapsed .menu-vertical .app-brand {
            padding-right: 0px;
            padding-left: 0px;
        }

        .layout-menu-collapsed .app-brand-logo img {
            width: 80px !important;
        }

        .modal.dtr-bs-modal .modal-body {
            position: unset;
        }

        /*remove space between 2 td in modal datatable */
        .modal.dtr-bs-modal .table tr>td:nth-child(2) {
            padding: 0px !important;
        }

        .drop-area {
            display: block;
            border: 2px dashed #cccccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 15px;
            transition: background-color 0.3s ease;
            z-index: 1;
        }

        .drop-area.dragging {
            background-color: #f0f8ff;
            border-color: #8a8787;
        }

        .media-file-item {
            position: relative;
            display: inline-block;
            margin: 8px;
            overflow: hidden;
            width: 260px;
            min-height: 46px;
            background-color: #767b8b;
            color: white;
            border-radius: 8px;
            padding: 5px 10px;
        }

        .media-file-image {

            /* max-width: 200px;
            height: 200px; */
            object-fit: cover;
            overflow: hidden;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            /* Light background to show alt text */
            text-align: center;
            color: #999999;
        }

        .file-info-overlay {
            /* position: absolute;
            bottom: 0;
            left: 0;
            right: 0; */
            /* background-color: rgba(0, 0, 0, 0.7); */
            color: white;
            padding: 5px;
            font-size: 12px;
            text-align: start;
            /* direction: ltr; */
        }


        .remove-file-overlay {
            background-color: rgba(19, 18, 18, 0.8);
            color: white;
            text-align: center;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
            z-index: 12;
            border: 2px solid rgba(19, 18, 18, 0.8);
            transition: border-color 0.1s ease-in-out;
        }

        .remove-file-overlay:hover {
            border-color: white;
        }


        .circular-progress {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 25px;
            height: 25px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 8px;
            font-weight: bold;
            z-index: 11;
        }

        .circular-progress::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .progress-percentage {
            z-index: 1;
        }

        .input-group {
            align-items: inherit;
            /* Align items center */
        }

        #accordionStyle1 [disabled] {
            background-color: unset;
        }

        .btn {
            display: inline-block;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif !important;
        }
    </style>

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') . '?v=2' }}" />

    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <style>
        /* .filepond--credits {
            display: none;
        } */

        .filepond--panel-root {
            border: 2px dashed #cccccc;
            background-color: #fff;
        }
    </style>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script>
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute("content");

        document.addEventListener('DOMContentLoaded', function() {
            const filepondElements = document.querySelectorAll('.filepond');
            filepondElements.forEach((element) => {
                const files = JSON.parse(element.getAttribute('data-files') || '[]');
                const pond = FilePond.create(element, {
                    files: files,
                    credits: false,
                    server: {
                        process: {
                            url: '{{ route('dashboard.media.store') }}', // Replace with your server endpoint
                            method: 'POST',
                            withCredentials: false,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            ondata: (formData) => {
                                let newFormData = new FormData();
                                formData.forEach((value, key) => {
                                    if (value instanceof File) {
                                        newFormData.append(element.name, value);
                                    }
                                });
                                return newFormData;
                            },
                            onload: (response) => {
                                try {
                                    const res = JSON.parse(response);
                                    return res.path;
                                } catch (e) {
                                    console.error('Invalid FilePond response:', response);
                                    return null;
                                }
                            }
                        },
                    },
                });

                // Load files if available
                // files.forEach((file) => {
                //     pond.addFile(file.url, {
                //         metadata: file.metadata
                //     });
                // });
            });
        });
    </script>

    <!-- Helpers -->
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets') }}/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets') }}/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @includeIf('dashboard.layouts.aside')
            <!-- Layout container -->
            <div class="layout-page">

                <div class="row pt-4 pb-3 mb-2 bg-white px-4 d-flex justify-content-between mx-0 w-100">
                    @includeIf('dashboard.layouts.header')
                </div>
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y pt-2">
                        <x-dashboard.alerts />

                        @yield('content')

                    </div>

                    @includeIf('dashboard.layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <script src="{{ asset('assets') }}/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/moment/moment.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/flatpickr/flatpickr.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    {{-- <script src="{{ asset('assets') }}/js/tables-datatables-extensions.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/select2/select2.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets') }}/js/main.js?v=2"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/form-layouts.js"></script>

    <!-- Block UI JS -->
    <script src="{{ asset('assets') }}/vendor/libs/block-ui/block-ui.js"></script>
    <script src="{{ asset('assets') }}/js/extended-ui-blockui.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/dashboards-analytics.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

    @includeIf('dashboard.layouts.modals')
    <script>
        // function cleaveMask(selector = '.numeral-mask') {
        //     document.addEventListener('DOMContentLoaded', function() {
        //         var inputFields = document.querySelectorAll(selector);
        //         inputFields.forEach(function(input) {
        //             new Cleave(input, {
        //                 numeral: true,
        //                 numeralThousandsGroupStyle: "thousand"
        //             });
        //         });
        //     });
        // }

        // cleaveMask()
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var url = window.location.protocol + '//' + window.location.hostname + ":8000" + window.location
                .pathname;
            $('ul.menu-inner > li.menu-item > a.menu-link').each(function() {
                if (this.href.replace(":8000", "").toLowerCase() == url.replace(":8000", "")
                    .toLowerCase()) {
                    $(this).parent('li.menu-item').addClass('active');
                }
            });
            $('ul.menu-inner > li.menu-item > ul.menu-sub > li > a.menu-link').each(function() {
                if (this.href.replace(":8000", "").toLowerCase() == url.replace(":8000", "")
                    .toLowerCase()) {
                    $(this).parent('li.menu-item').addClass('active');
                    $(this).closest('ul.menu-sub').closest('li.menu-item').addClass('active open');
                }
            });
            $('ul.menu-inner > li.menu-item > ul.menu-sub > li.menu-item > ul.menu-sub > li.menu-item > a.menu-link')
                .each(function() {
                    if (this.href.replace(":8000", "").toLowerCase() == url.replace(":8000", "")
                        .toLowerCase()) {
                        $(this).parent('li.menu-item').addClass('active');
                        $(this).closest('ul.menu-sub').closest('li.menu-item').addClass('active open');
                        $(this).closest('ul.menu-sub').closest('li.menu-item').closest('ul.menu-sub').closest(
                            'li.menu-item').addClass('active open');
                    }
                });
        });
    </script>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            var dropArea = $('.drop-area');
            var fileInput = dropArea.find('input[type="file"]');

            $('.media-file-list').sortable({
                revert: 200,
                //axis: 'x', // Restrict sorting to horizontal (x-axis)
                //placeholder: "ui-state-highlight", // Placeholder style when dragging
                update: function(event, ui) {
                    // This function is triggered after sorting
                    //updateFileOrder();
                }
            });

            // Prevent default drag and drop behaviors
            $(document).on('dragenter dragover dragleave drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
            });

            // Highlight drop area when item is dragged over it
            dropArea.on('dragenter dragover', function() {
                dropArea.addClass('dragging');
            });

            dropArea.on('dragleave drop', function() {
                dropArea.removeClass('dragging');
            });

            // Handle dropped files
            dropArea.on('drop', function(e) {
                var files = e.originalEvent.dataTransfer.files;
                handleFiles(files);
            });

            // Trigger file input change event (for manual file selection)
            fileInput.change(function() {
                var files = fileInput[0].files;
                handleFiles(files);
            });

            // Function to handle file uploads
            function handleFiles(files) {
                $.each(files, function(index, file) {
                    uploadFile(file);
                });
            }

            // Function to format file size
            function formatFileSize(size) {
                if (size >= 1024 * 1024 * 1024) {
                    return (size / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
                } else if (size >= 1024 * 1024) {
                    return (size / (1024 * 1024)).toFixed(2) + ' MB';
                } else {
                    return (size / 1024).toFixed(2) + ' KB';
                }
            }

            // Function to upload and display file with circular progress
            function uploadFile(file) {
                var fileId = 'file_' + (new Date().getTime()); // unique ID for file

                let fileTemplate = `<div class="img-thumbnail align-middle me-2"
                                            style="height:40px; width:40px; display: flex; justify-content: center; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                                fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                            </svg>
                                        </div>`;


                const previewTemplate = `<div class="media-file-item" id="${fileId}">
                        <input type="hidden" name="${fileInput.attr('data-name')}[]" value="" />
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="file-info-overlay">
                                <a class="d-flex align-middle text-white" target="_blank" href="">
                                        <img class="img img-thumbnail align-middle me-2 rounded-1"
                                            style="height:40px; width:40px; object-fit: cover;"
                                            src="" />
                                    <div class="">
                                        <p class="m-0">${file.name}</p>
                                        <small class="m-0">(${formatFileSize(file.size)})</small>
                                    </div>
                                </a>

                            </div>
                            <div class="remove-file-overlay">
                                <svg width="26" height="26" viewBox="0 0 26 26"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.586 13l-2.293 2.293a1 1 0 0 0 1.414 1.414L13 14.414l2.293 2.293a1 1 0 0 0 1.414-1.414L14.414 13l2.293-2.293a1 1 0 0 0-1.414-1.414L13 11.586l-2.293-2.293a1 1 0 0 0-1.414 1.414L11.586 13z"
                                        fill="currentColor" fill-rule="nonzero"></path>
                                </svg>
                            </div>
                        </div>
                    </div>`;

                $('.media-file-list').append(previewTemplate);

                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + fileId).find('img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#' + fileId).find('img').replaceWith(fileTemplate);
                }

                var formData = new FormData();
                formData.append('_token', document.head.querySelector('meta[name="csrf-token"]').getAttribute(
                    "content"));
                formData.append('file', file, file.name);

                var url = "{{ route('dashboard.media.upload') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.floor(position / total * 100);
                                }
                                // Update the circular progress and percentage
                                $('#' + fileId).find(".progress-percentage").html(percent);
                            }, true);
                        }
                        return xhr;
                    },
                    success: function(obj) {
                        if (typeof obj.success !== 'undefined' && obj.success === true) {
                            $('#' + fileId).find('input[type="hidden"]').val(obj.path);
                        } else if (typeof obj.success !== 'undefined' && obj.success === false) {
                            $('#' + fileId).find('.progress').after('<div class="error">' + obj
                                .message + '</div>');
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            // Remove file handler
            $(document).on('click', '.remove-file-overlay', function() {
                $(this).closest('.media-file-item').remove(); // Remove file preview
            });
        });
    </script>

    <script type="text/javascript">
        const language = {
            'export': {
                'en': 'Export',
                'ar': 'تصدير'
            },
            'print': {
                'en': 'Print',
                'ar': 'طباعة'
            },
            'copy': {
                'en': 'Copy',
                'ar': 'نسخ'
            },
            'details': {
                "en": "Details",
                "ar": "التفاصيل",
            },
        };

        function trans(key) {
            return language[key][document.documentElement.lang] ?? '';
        }

        $(document).ready(function() {
            var dataTableButtons = [{
                extend: 'collection',
                className: 'btn btn-label-primary dropdown-toggle mx-3',
                text: `<i class="bx bx-export me-1"></i>${trans('export')}`,
                buttons: [{
                        extend: 'print',
                        text: `<i class="bx bx-printer me-2" ></i>${trans('print')}`,
                        className: 'dropdown-item',
                        customize: function(win) {
                            //customize print view for dark
                            $(win.document.body)
                                .css('color', headingColor)
                                .css('border-color', borderColor)
                                .css('background-color', bodyBg);
                            $(win.document.body)
                                .find('table')
                                .addClass('compact')
                                .css('color', 'inherit')
                                .css('border-color', 'inherit')
                                .css('background-color', 'inherit');
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="bx bx-file me-2" ></i>Csv',
                        className: 'dropdown-item',
                        customize: function(csv) {
                            return '\uFEFF' + csv;
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bx bxs-file-export me-2"></i>Excel',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'copy',
                        text: `<i class="bx bx-copy me-2" ></i>${trans('copy')}`,
                        className: 'dropdown-item',
                    }
                ]
            }];

            var dataTableLanguage = function() {
                return {
                    'ar': {
                        "sProcessing": "جارٍ التحميل...",
                        "sLengthMenu": "_MENU_",
                        "sZeroRecords": "لم يعثر على أية سجلات",
                        "sInfo": "يتم عرض _START_ إلى _END_ من _TOTAL_ مدخل",
                        "sInfoEmpty": "يعرض 0 إلى 0 من 0 سجل",
                        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                        "sInfoPostFix": "",
                        "sSearch": "",
                        "searchPlaceholder": "ابحث..",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "الأول",
                            "sPrevious": "السابق",
                            "sNext": "التالي",
                            "sLast": "الأخير"
                        }
                    },
                    'en': {}
                } [document.documentElement.lang] ?? {};
            };

            const table = $('.datatables-basic')
            if (table) {
                //for responsive icon
                table.find('thead tr').prepend('<th></th>');

                let tableColumns = [];
                table.find('thead tr th').each(function() {
                    tableColumns.push({
                        data: $(this).data('column')
                    });
                });

                let tablePagination = '';
                let tableHeader = '';
                let showPagination = table.attr('pagination')
                let showExport = table.attr('export')
                let showSearch = table.attr('search')

                if (showExport == 'true' || showSearch == 'true') {
                    tableHeader +=
                        '<"col-md-12"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"'
                    if (showSearch == 'true') {
                        tableHeader += 'f'
                    }
                    if (showExport == 'true') {
                        tableHeader += 'B'
                    }
                    tableHeader += '>>'
                }
                if (!showPagination || showPagination == 'true') {
                    tablePagination = '<"col-sm-12 col-md-4"i>' +
                        '<"col-sm-12 col-md-4"p>';
                }

                var basicDataTable = table.DataTable({
                    "searchDelay": 1000,
                    "searchable": false,
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 25,
                    "ajax": {
                        url: table.data('href'),
                        type: 'GET',
                        data: function(d) {
                            const data = $('#datatablesFilter').serializeArray();

                            let filter = {}
                            $.map(data, function(input) {
                                filter[input['name']] = input['value'];
                            });
                            return $.extend({}, d, {
                                ...filter
                            });
                        }
                    },
                    dom: '<"row mx-2"' +
                        tableHeader +
                        't>' +
                        '<"row mx-2"' +
                        '<"col-sm-12 col-md-4"l>' +
                        tablePagination +
                        '>',
                    "language": {
                        ...dataTableLanguage(),
                        ...{
                            //here rou can add more language
                        }
                    },
                    "buttons": [...dataTableButtons, [
                        //here rou can add more buttons
                    ]],
                    columnDefs: [{
                        // For Responsive
                        className: 'control',
                        searchable: false,
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return '';
                        }
                    }],
                    columns: tableColumns,
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return trans('details');
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.title !==
                                        '' // ? Do not show row in modal popup if title is blank (for check box)
                                        ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table class="table"/><tbody />').append(data) :
                                    false;
                            }
                        }
                    },
                });


                setTimeout(() => {
                    $('.dataTables_filter .form-control').removeClass('form-control-sm');
                    $('.dataTables_length .form-select').removeClass('form-select-sm');

                    //prevent form submit to tatatable reload
                    const searchButton = document.getElementById('datatablesFilter');
                    if (searchButton) {
                        if (!searchButton.hasAttribute('data-refresh')) {
                            searchButton.submit = (e) => {
                                basicDataTable.ajax.reload();
                            };
                        }
                    }
                }, 300);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').change(function() {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input[type="date"]').forEach(function (input) {
                input.addEventListener('click', function () {
                    if (this.showPicker) {
                        this.showPicker();
                    }
                });
            });
        });
    </script>

    @includeIf('dashboard.layouts.validation-script')
    @stack('scripts')
</body>

</html>

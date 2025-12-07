<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @stack('meta')

    <title>Dashboard | {{ app('settings')->find('name') }}</title>

    <meta name="description" content="" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />

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
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/theme-default.css"
            class="template-customizer-theme-css" />
    @else
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
            class="template-customizer-theme-css" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css?v=1" />

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

        :root {
            --bs-primary: {{ app('settings')->find('primary-color', '#696cff') }};
            --bs-link-color: {{ app('settings')->find('primary-color', '#696cff') }};
        }
    </style>

    <!-- Page CSS -->

    @stack('styles')

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

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y pt-2">
                        @stack('breadcrumbs')
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
    <script src="{{ asset('assets') }}/vendor/libs/select2/select2.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>


    <!-- Main JS -->
    <script src="{{ asset('assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/form-layouts.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/dashboards-analytics.js"></script>

    @includeIf('dashboard.layouts.modals')

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
            }
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
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bx bxs-file-export me-2"></i>Excel',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
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
            let tableColumns = [];
            table.find('thead tr th').each(function() {
                tableColumns.push({
                    data: $(this).data('column')
                });
            });

            var basicDataTable = table.DataTable({
                "searchDelay": 1000,
                "searchable": false,
                "processing": true,
                "serverSide": true,
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
                dom: '<"row mx-2"t>' +
                    '<"row mx-2"' +
                    '<"col-sm-12 col-md-4"l>' +
                    '<"col-sm-12 col-md-4"i>' +
                    '<"col-sm-12 col-md-4"p>' +
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
                columns: tableColumns,
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

        });
    </script>

    @includeIf('dashboard.layouts.validation-script')
    @stack('scripts')
</body>

</html>

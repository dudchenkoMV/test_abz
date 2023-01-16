<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Test task') }}</title>


    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body>
    @yield('body')

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="//cdn.datatables.net/plug-ins/1.13.1/dataRender/datetime.js"></script>
    <script>
        $(function () {
            $('#employees-table').dataTable({
                paging: true,
                lengthChange: true,
                lengthMenu: [50, 100, 150],
                searching: true,
                ordering: true,
                order: [1, 'asc'],
                info: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'employees-datasource',
                    type: 'POST',
                },
                columns: [
                    { data: 'photo', name: 'photo', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'position', name: 'position' },
                    { data: 'employment_at', name: 'employment_at', render: DataTable.render.moment('DD.MM.YY')},
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'salary', name: 'salary', render: DataTable.render.number(' ', ',', 3, '$')},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                stateSave: true,
                stateSaveCallback: function(settings, data) {
                    localStorage.setItem( 'EmployeeDataTable_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                    return JSON.parse( localStorage.getItem( 'EmployeeDataTable_' + settings.sInstance ) )
                }
            });

            $('#employees-table tbody').on('click', '#employee_delete_button', function () {
                let name = $(this).data('name');
                let href = $(this).data('href');
                $('#employee_modal_name').text(name);
                $('#employee_modal_delete').attr('action', href);
            });

            $('#positions-table').dataTable({
                paging: true,
                lengthChange: true,
                lengthMenu: [50, 100, 150],
                searching: true,
                ordering: true,
                order : [1, 'asc'],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'updated_at', name: 'updated_at',
                        render: function(data) {
                            return moment(data).format('DD.MM.YY');
                        }
                    },
                    { data: 'action', name: 'action'}
                ],
                info: true,
                autoWidth: false,
                responsive: false,
                processing: true,
                stateSave: true,
                stateSaveCallback: function(settings, data) {
                    localStorage.setItem( 'PositionDataTable_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                    return JSON.parse( localStorage.getItem( 'PositionDataTable_' + settings.sInstance ) )
                }
            });

            $('#positions-table tbody').on('click', '#position_delete_button', function () {
                let name = $(this).data('name');
                let href = $(this).data('href');
                $('#position_modal_name').text(name);
                $('#position_modal_delete').attr('action', href);
            });
        });
    </script>
    <script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(function() {
            $('[data-mask]').inputmask();
        });

        $('#reservationdate').datetimepicker({
            format: 'DD.MM.YY',
        });
    </script>
    <script>
        $(function () {
            $('#photo_button').on('click', function() {
               $('#photo_input').click();
            });
        });
    </script>
</body>
</html>

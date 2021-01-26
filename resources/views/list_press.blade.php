@extends(backpack_view('layouts.top_left'))
<title>Data Press :: Lembur</title>
@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">Data Pekerjaan Press</span>
            <small id="datatable_info_stack" class="animated fadeIn" style="display: inline-flex;">
                <div class="dataTables_info" id="crudTable_info" role="status" aria-live="polite">
                    Showing {{ $data->currentPage() }} to {{ $data->total() }} of {{ $data->total() }} entries.
                </div>
                <a href="{{ url('press') }}" class="ml-1" id="crudTable_reset_button">Reset</a>
            </small>
        </h2>
    </div>
@endsection

@section('content')

    <div class="row">
        <!-- THE ACTUAL CONTENT -->
        <div class="col-md-12">
            <div class="row mb-0">
                <div class="col-sm-6">
                    <div class="hidden-print with-border">
                        <a href="{{ url('create_press') }}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="la la-plus"></i> Add Pekerjaan</span></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="datatable_search_stack" class="mt-sm-0 mt-2"></div>
                </div>
            </div>
            <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
                <thead>
                <tr>
                    <th

                    >Tanggal</th>
                    <th>Shift</th>
                    <th>NIK 1</th>
                    <th>NIK 2</th>
                    <th>NIK 3</th>
                    <th>NIK 4</th>
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $datas)
                    <tr>
                        <td>{{ date('d/m/Y',strtotime($datas->tanggal)) }}</td>
                        <td>{{ $datas->id_shift }}</td>
                        <td>{{ $datas->nik1 }}</td>
                        <td>{{ $datas->nik2 }}</td>
                        <td>{{ $datas->nik3 }}</td>
                        <td>{{ $datas->nik4 }}</td>
                        <td>{{ $datas->kode_bahan }}</td>
                        <td>{{ $datas->jumlah }}</td>
                        <td>
                            <a href="{{ url('/press/edit{$id}') }}" class="btn btn-sm btn-link" data-button-type="edit"><i class="la la-edit"></i>Edit</a>
                            <a href="javascript:void(0)" onclick="deleteEntry(this)" data-id="{{ $datas->id }}" data-route="{{ url('press/hapus/'.$datas->id) }}" class="btn btn-sm btn-link" data-button-type="delete"><i class="la la-trash"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Tanggal</th>
                    <th>Shift</th>
                    <th>NIK 1</th>
                    <th>NIK 2</th>
                    <th>NIK 3</th>
                    <th>NIK 4</th>
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script>

        if (typeof deleteEntry != 'function') {
            $("[data-button-type=delete]").unbind('click');

            function deleteEntry(button) {
                // ask for confirmation before deleting an item
                // e.preventDefault();
                var button = $(button);
                var id = $("[data-button-type=delete]").data('id');
                var route = button.attr('data-route');
                var row = $("#crudTable a[data-route='"+route+"']").closest('tr');
                var token = $("meta[name='csrf-token']").attr('content');
                swal({
                    title: "{!! trans('backpack::base.warning') !!}",
                    text: route + "{!! trans('backpack::crud.delete_confirm') !!}",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "{!! trans('backpack::crud.cancel') !!}",
                            value: null,
                            visible: true,
                            className: "bg-secondary",
                            closeModal: true,
                        },
                        delete: {
                            text: "{!! trans('backpack::crud.delete') !!}",
                            value: true,
                            visible: true,
                            className: "bg-danger",
                        }
                    },
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            url: route,
                            type: 'DELETE',
                            data : {
                                _token:token,
                                id: id
                            },
                            success: function(result) {
                                if (result == 1) {
                                    // Show a success notification bubble
                                    new Noty({
                                        type: "success",
                                        text: "{!! '<strong>'.trans('backpack::crud.delete_confirmation_title').'</strong><br>'.trans('backpack::crud.delete_confirmation_message') !!}"
                                    }).show();

                                    // Hide the modal, if any
                                    $('.modal').modal('hide');

                                    // Remove the details row, if it is open
                                    if (row.hasClass("shown")) {
                                        row.next().remove();
                                    }

                                    // Remove the row from the datatable
                                    row.remove();
                                } else {
                                    // if the result is an array, it means
                                    // we have notification bubbles to show
                                    if (result instanceof Object) {
                                        // trigger one or more bubble notifications
                                        Object.entries(result).forEach(function(entry, index) {
                                            var type = entry[0];
                                            entry[1].forEach(function(message, i) {
                                                new Noty({
                                                    type: type,
                                                    text: message
                                                }).show();
                                            });
                                        });
                                    } else {// Show an error alert
                                        swal({
                                            title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                            text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                            icon: "error",
                                            timer: 4000,
                                            buttons: false,
                                        });
                                    }
                                }
                            },
                            error: function(result) {
                                // Show an alert with the result
                                swal({
                                    title: result +"{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                    text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                    icon: "error",
                                    timer: 4000,
                                    buttons: false,
                                });
                            }
                        });
                    }
                });

            }
        }

        // make it so that the function above is run after each DataTable draw event
        // crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
    </script>
@endsection

@section('after_styles')
    <!-- DATA TABLES -->
    <script src="{{asset('packages/jquery-ui-dist/external/jquery/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection

@section('after_scripts')

    <script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/list.js') }}"></script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
@endsection


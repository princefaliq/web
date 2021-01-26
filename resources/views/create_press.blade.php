@extends(backpack_view('layouts.top_left'))

@section('header')
{{--    <script src="packages/$-ui-dist/external/$/$.js"></script>--}}
   {{-- <script src="packages/select2/dist/js/select2.js"></script>--}}

    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">Create Pekerjaan Press</span>
                <small>Add Pekerjaan.</small>
                <small>
                        <a href="{{ url('press') }}" class="hidden-print font-sm">
                            <i class="la la-angle-double-left"></i> Back to all  <span>Data Pekerjaan Press</span>
                        </a>
                </small>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 bold-labels">
          @if ($errors->any())
                <div class="alert-danger ">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="created" method="post" action="/press/simpan" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body row">
                        <!-- Default box -->
                        {!! csrf_field() !!}
                        <div class="form-group col-md-12 ">
                            <label for="tanggal">Tanggal</label>
                            <input
                                type="date"
                                name="tanggal"
                                id="tanggal"
                                value= "<?php echo date("Y-m-d"); ?>"
                                class="form-control"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="shift">
                                @if ($errors->has('shift'))
                                    <i class="alert-info">Shift<sup>*harap di isi</sup></i>
                                @else
                                    Shift
                                @endif
                            </label>
                            <select
                                name="shift"
                                id="shift"
                                class="form-control required"
                            >
                                <option value="">Select Shift</option>
                                @foreach ($data_pegawai as $id => $shift)
                                    <option value="{{ $id }}">{{ $shift }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="nik1">NIK 1</label>
                            <select
                                name="nik1"
                                id="nik1"
                                class="form-control required"
                            >
                                <option value="">Select NIK ke Satu</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="nik1">NIK 2</label>
                            <select
                                name="nik2"
                                id="nik2"
                                class="form-control"
                            >
                                <option value="">Select NIK ke Dua</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="nik1">NIK 3</label>
                            <select
                                name="nik3"
                                id="nik3"
                                class="form-control"
                            >
                                <option value="">Select NIK ke Tiga</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="nik1">NIK 4</label>
                            <select
                                name="nik4"
                                id="nik4"
                                class="form-control"
                            >
                                <option value="">Select NIK ke Empat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12 ">
                            <label for="bahan_2_0">Bahan 2.0</label>
                            <input
                                type="number"
                                name="bahan_2_0"
                                id="bahan_2_0"
                                value="0"
                                class="form-control required"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_3_1">Bahan 3.1</label>
                            <input
                                type="number"
                                name="bahan_3_1"
                                id="bahan_3_1"
                                value="0"
                                class="form-control required"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_4x8">Bahan 4 x 8</label>
                            <input
                                type="number"
                                name="bahan_4x8"
                                id="bahan_4x8"
                                value="0"
                                class="form-control required"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_service">Service</label>
                            <input
                                type="number"
                                name="bahan_service"
                                id="bahan_service"
                                value="0"
                                class="form-control required"
                            >
                        </div>
                            <input
                                type="hidden"
                                value="{{ backpack_user()->id }}"
                                name="id_user"
                                id="id_user"
                                value="0"
                                class="form-control"
                            >
                    </div>
                </div>
                <div id="saveActions" class="form-group">
                    <input type="hidden" name="save_action" value="send_and_back">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-success">
                            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span data-value="save_and_back">Simpan dan kembali</span>
                        </button>
                    </div>
                    <a href="{{ url('/press') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script src={{ url("packages/jquery-ui-dist/external/jquery/jquery.js") }}></script>
    <script src="{{ url('packages/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery('document').ready(function ($)
        {
            // data select2
            $('#shift,#nik1,#nik2,#nik3,#nik4').select2();

            $('#shift').on('change',function(){
                var data_shift = $('select[name="shift"]').val();

                $.ajax({
                    url : "{{ route('getnik1prees') }}",
                    data : {
                        'data_shift':data_shift
                    },
                    type : 'GET',
                    dataType : 'json',
                    success : function (data)
                    {
                        $('#nik1').html(data.html);
                    }
                })

            });

            $('#nik1').on('change',function(){
                var nik1 = $('select[name="nik1"]').val();
                var data_shift = $('select[name="shift"]').val();
                $('#nik2').empty();
                    $.ajax({
                        url : "{{ route('getnik2prees') }}",
                        data : {
                            'data_shift':data_shift,
                            'nik1' : nik1,
                        },
                        type : 'GET',
                        dataType : 'json',
                        success : function (data)
                        {
                            $('#nik2').html(data.html);
                        }
                    })

            });

            $('#nik2').on('change',function(){
                var nik1 = $('select[name="nik1"]').val();
                var nik2 = $('select[name="nik2"]').val();
                var data_shift = $('select[name="shift"]').val();
                $('#nik3').empty();
                $.ajax({
                    url : "{{ route('getnik3prees') }}",
                    data : {
                        'data_shift':data_shift,
                        'nik1' : nik1,
                        'nik2' : nik2,
                    },
                    type : 'GET',
                    dataType : 'json',
                    success : function (data)
                    {
                        $('#nik3').html(data.html);
                    }
                })

            });

            $('#nik3').on('change',function(){
                var nik1 = $('select[name="nik1"]').val();
                var nik2 = $('select[name="nik2"]').val();
                var nik3 = $('select[name="nik3"]').val();
                var data_shift = $('select[name="shift"]').val();
                $('#nik4').empty();
                $.ajax({
                    url : "{{ route('getnik4prees') }}",
                    data : {
                      'data_shift':data_shift,
                      'nik1' : nik1,
                      'nik2' : nik2,
                      'nik3' : nik3
                    },
                    type : 'GET',
                    dataType : 'json',
                    success : function (data)
                    {
                        $('#nik4').html(data.html);
                    }
                })

            });
        })


    </script>
@endsection



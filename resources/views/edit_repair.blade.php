@extends(backpack_view('layouts.top_left'))
@section('header')
    {{--    <script src="packages/jquery-ui-dist/external/jquery/jquery.js"></script>--}}
    {{-- <script src="packages/select2/dist/js/select2.js"></script>
     <link href="packages/select2/dist/css/select2.min.css" rel="stylesheet" />--}}
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">Create Pekerjaan Repair</span>
            <small>Add Pekerjaan.</small>
            <small>
                <a href="{{ url('repair') }}" class="hidden-print font-sm">
                    <i class="la la-angle-double-left"></i> Back to all  <span>Data Pekerjaan Repair</span>
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
            <form id="created" method="post" action="/repair/Simpanedit/{{ $repair->id }}" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body row">
                        <!-- Default box -->
                        {!! csrf_field() !!}
                        {!! method_field('PUT') !!}
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
                            <label for="shift">Shift</label>
                            <select
                                name="shift"
                                id="shift"
                                class="form-control"
                            >
                                <option value="">Pilih Shift</option>
                                @foreach ($data_pegawai as $id => $shift)
                                    @if ($repair->shift == $id)
                                        <option value="{{ $id }}" selected>{{ $shift }}</option>
                                    @else
                                        <option value="{{ $id }}">{{ $shift }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="nik1">NIK 1</label>
                            <select
                                name="nik1"
                                id="nik1"
                                class="form-control"
                            >
                                <option value="">Select NIK ke Satu</option>
                                @foreach($nik1 as $dataNik1)
                                    @if ($repair->nik1 == $dataNik1->nik)
                                        <option value="{{$dataNik1->nik}}" selected>{{$dataNik1->nik}}-{{ $dataNik1->nama }}</option>
                                    @else
                                        <option value="{{$dataNik1->nik}}">{{$dataNik1->nik}}-{{ $dataNik1->nama }}</option>
                                    @endif
                                @endforeach
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
                                @foreach($nik2 as $dataNik2)
                                    @if ($repair->nik2 == $dataNik2->nik)
                                        <option value="{{$dataNik2->nik}}" selected>{{$dataNik2->nik}}-{{ $dataNik2->nama }}</option>
                                    @else
                                        <option value="{{$dataNik2->nik}}">{{$dataNik2->nik}}-{{ $dataNik2->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input
                            type="hidden"
                            value="{{ backpack_user()->id }}"
                            name="id_user"
                            id="id_user"
                            class="form-control"
                        >
                    </div>
                </div>
                <div class="tab-container  mb-2">
                    <div class="nav-tabs-custom " id="form_tabs">
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="nav-item">
                                <a href="#tab_jumlah" aria-controls="tab_jumlah" role="tab" tab_name="jumlah" data-toggle="tab" class="nav-link active">Jumlah</a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#tab_potongan" aria-controls="tab_potongan" role="tab" tab_name="potongan" data-toggle="tab" class="nav-link ">Potongan</a>
                            </li>
                        </ul>
                        <div class="tab-content p-0 ">

                            <div role="tabpanel" class="tab-pane  active" id="tab_jumlah">

                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label for="bahan_2_0">Bahan 2 0</label>
                                        <input
                                            type="number"
                                            name="bahan_2_0"
                                            id="bahan_2_0"
                                            class="form-control required"
                                            value="{{ $repair->bahan_2_0 }}"
                                        >
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="bahan_3_1">Bahan 3 1</label>
                                        <input
                                            type="number"
                                            name="bahan_3_1"
                                            id="bahan_3_1"
                                            class="form-control required"
                                            value="{{ $repair->bahan_3_1 }}"
                                        >
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="bahan_bc">Bahan BC</label>
                                        <input
                                            type="number"
                                            name="bahan_bc"
                                            id="bahan_bc"
                                            class="form-control required"
                                            value="{{ $repair->bahan_bc }}"
                                        >
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="bahan_lc_31">Bahan LC 31</label>
                                        <input
                                            type="number"
                                            name="bahan_lc_31"
                                            id="bahan_lc_31"
                                            class="form-control required"
                                            value="{{ $repair->bahan_lc_31 }}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="tab_potongan">
                                <div class="row">
                                    <div class="form-group col-md-12 ">
                                        <label for="pot_2_0">Potongan 2 0</label>
                                        <input
                                            type="number"
                                            name="pot_2_0"
                                            id="pot_2_0"
                                            class="form-control required"
                                            value="{{ $repair->pot_2_0 }}"
                                        >
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="pot_3_1">Potongan 3 1</label>
                                        <input
                                            type="number"
                                            name="pot_3_1"
                                            id="pot_3_1"
                                            class="form-control required"
                                            value="{{ $repair->pot_3_1 }}"
                                        >
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="pot_bc">Potongan BC</label>
                                        <input
                                            type="number"
                                            name="pot_bc"
                                            id="pot_bc"
                                            class="form-control required"
                                            value="{{ $repair->pot_bc }}"
                                        >
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label for="bahan_lc_31">Potongan LC 31</label>
                                        <input
                                            type="number"
                                            name="pot_lc_31"
                                            id="pot_lc_31"
                                            class="form-control required"
                                            value="{{ $repair->pot_lc_31 }}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <a href="{{ url('/repair') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script src={{ url("packages/jquery-ui-dist/external/jquery/jquery.js") }}></script>
    <script src="{{ url('packages/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery('document').ready(function ($)
        {
            $('#id_shift,#nik1,#nik2').select2();

            $('#id_shift').on('change',function(){
                var data_shift = $('#id_shift').val();

                $.ajax({
                    url : "{{ route('getnik1repair') }}",
                    data : {
                        'data_shift':data_shift,
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
                var nik1 = $('#nik1').val();
                var data_shift = $('#id_shift').val();
                $('#nik2').empty();
                $.ajax({
                    url : "{{ route('getnik2repair') }}",
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

        });

    </script>
@endsection


@extends(backpack_view('layouts.top_left'))
@section('header')
    {{--    <script src="packages/jquery-ui-dist/external/jquery/jquery.js"></script>--}}
    {{-- <script src="packages/select2/dist/js/select2.js"></script>
     <link href="packages/select2/dist/css/select2.min.css" rel="stylesheet" />--}}
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">Edit Pekerjaan Press</span>
            <small>Edit Pekerjaan.</small>
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
            <form method="post" action="/press/Simpanedit/{{ $press->id }}" enctype="multipart/form-data">
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
                                value= {{ $press->tanggal }}
                                class="form-control"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="id_shift">Shift</label>
                            <select
                                name="id_shift"
                                id="id_shift"
                                class="form-control"
                            >
                                <option value="">Pilih Shift</option>
                                @foreach ($data_pegawai as $id => $shift)
                                    @if ($press->id_shift == $id)
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
                                    @if ($press->nik1 == $dataNik1->nik)
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
                                    @if ($press->nik2 == $dataNik2->nik)
                                        <option value="{{$dataNik2->nik}}" selected>{{$dataNik2->nik}}-{{ $dataNik2->nama }}</option>
                                    @else
                                        <option value="{{$dataNik2->nik}}">{{$dataNik2->nik}}-{{ $dataNik2->nama }}</option>
                                    @endif
                                @endforeach
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
                                @foreach($nik3 as $dataNik3)
                                    @if ($press->nik3 == $dataNik3->nik)
                                        <option value="{{$dataNik3->nik}}" selected>{{$dataNik3->nik}}-{{ $dataNik3->nama }}</option>
                                    @else
                                        <option value="{{$dataNik3->nik}}">{{$dataNik3->nik}}-{{ $dataNik3->nama }}</option>
                                    @endif
                                @endforeach
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
                                @foreach($nik4 as $dataNik4)
                                    @if ($press->nik4 == $dataNik4->nik)
                                        <option value="{{$dataNik4->nik}}" selected>{{$dataNik4->nik}}-{{ $dataNik4->nama }}</option>
                                    @else
                                        <option value="{{$dataNik4->nik}}">{{$dataNik4->nik}}-{{ $dataNik4->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_2_0">Bahan 2.0</label>
                            <input
                                type="number"
                                name="bahan_2_0"
                                id="bahan_2_0"
                                value="{{ $press->bahan_2_0 }}"
                                class="form-control required"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_3_1">Bahan 3.1</label>
                            <input
                                type="number"
                                name="bahan_3_1"
                                id="bahan_3_1"
                                value="{{ $press->bahan_3_1 }}"
                                class="form-control required"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_4x8">Bahan 4 x 8</label>
                            <input
                                type="number"
                                name="bahan_4x8"
                                id="bahan_4x8"
                                value="{{ $press->bahan_4x8 }}"
                                class="form-control required"
                            >
                        </div>

                        <div class="form-group col-md-12 ">
                            <label for="bahan_service">Service</label>
                            <input
                                type="number"
                                name="bahan_service"
                                id="bahan_service"
                                value="{{ $press->bahan_service }}"
                                class="form-control required"
                            >
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



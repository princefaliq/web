@extends(backpack_view('layouts.top_left'))

@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">Range Report Press</span>
            <small>Range Report.</small>
            <small>
                <a href="{{ url('laporan_press') }}" class="hidden-print font-sm">
                    <i class="la la-angle-double-left"></i> Back to all  <span>Data Report Press</span>
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
            <form id="created" method="post" action="laporan" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="card">
                    <div class="card-body row">
                        <div class="form-group col-md-6 ">
                            <label for="tgl_awal_press">Tanggal Awal Press</label>
                            <input
                                type="date"
                                name="tgl_awal_press"
                                id="tgl_awal_press"
                                class="form-control required datepicker"
                                placeholder="masukkan tanggal awal"
                            >
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="tgl_ahir_press">Tanggal Ahir Press</label>
                            <input
                                type="date"
                                name="tgl_ahir_press"
                                id="tgl_ahir_press"
                                class="form-control required datepicker"
                                placeholder="masukkan tanggal ahir"
                            >
                        </div>
                    </div>
                </div>
                <div id="saveActions" class="form-group">
                    <input type="hidden" name="save_action" value="send_and_back">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-success">
                            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span data-value="save_and_back">Proses</span>
                        </button>
                    </div>
                    <a href="{{ url('laporan_press/create') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Batal</a>
                </div>
            </form>
        </div>
    </div>

@endsection


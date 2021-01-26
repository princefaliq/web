<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Data_pegawai;
use App\Models\Press;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Prologue\Alerts\Facades\Alert as Pesan;
//se Prologue\Alerts as Pesan;
class PressController extends Controller
{
    public function ganti($id)
    {
        $press = DB::table('press')->find($id);
        $data_pegawai = DB::table('data_pegawai')->orderBy('id_shift')->pluck('id_shift', 'id_shift');
        $bahan = DB::table('bahan')
            ->where('pekerjaan','=','press')
            ->get();

        $nik1=DB::table('data_pegawai')
            ->where('id_shift','=',$press->id_shift)
            ->where('bagian','=','Press')
            ->get();

        $nik2 = DB::table('data_pegawai')
            ->where('id_shift','=',$press->id_shift)
            ->where('bagian','=', 'Press')
            ->where('nik','<>', $press->nik1)
            ->get();

        $nik3 = DB::table('data_pegawai')
            ->where('id_shift','=',$press->id_shift)
            ->where('bagian','=', 'Press')
            ->where('nik','<>', $press->nik1)
            ->where('nik','<>', $press->nik2)
            ->get();
        $nik4 = DB::table('data_pegawai')
            ->where('id_shift','=',$press->id_shift)
            ->where('bagian','=', 'Press')
            ->where('nik','<>', $press->nik1)
            ->where('nik','<>', $press->nik2)
            ->where('nik','<>', $press->nik3)
            ->get();

        return view('edit_press', [
            'press' => $press,
            'data_pegawai' => $data_pegawai,
            'bahan' => $bahan,
            'nik1' => $nik1,
            'nik2' => $nik2,
            'nik3' => $nik3,
            'nik4' => $nik4,
        ]);
        /*$data=DB::table('press')->orderBy('id','desc')->paginate(10);
        $banyak_data=$data->count();
        return view('list_press')
            ->with('data',$data)
            ->with('banyak',$banyak_data);*/
    }
    public function create_press()
    {
        $data_pegawai = DB::table('data_pegawai')
            ->where('bagian','=','press')
            ->orderBy('id_shift')
            ->pluck('id_shift', 'id_shift');
        $bahan = DB::table('bahan')
            ->where('pekerjaan','=','press')
            ->get();
        return view('create_press', [
            'data_pegawai' => $data_pegawai,
            'bahan' => $bahan,
        ]);
        //return view('create_press');
    }
    public function getnik1($id)
    {
        $nik1=DB::table('data_pegawai')
            ->where('id_shift',$id)
            ->where('bagian','=','Press')
            ->pluck('nama','nik');
        return json_encode($nik1);
    }


    public function getnik2(Request $request)
    {
        if (!$request->nik and !$request->data_shift)
        {
            $html = '<option value="">silahkan input nik</option>';
        }
        else
        {
            $html = '<option value="">Pilih NIK 2</option>';
            $data = DB::table('data_pegawai')
                ->where('id_shift','=', $request->get('data_shift'))
                ->where('bagian','=', 'Press')
                ->where('nik','<>', $request->get('nik'))
                ->get();
           //$data->where('shift','<>',$request->nik);
            foreach ($data as $datas) {
                $html .= '<option value="'.$datas->nik.'">'.$datas->nik.'-'.$datas->nama.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function getnik3(Request $request)
    {
        if (!$request->nik2 and !$request->nik1 and !$request->data_shift)
        {
            $html = '<option value="">silahkan input nik</option>';
        }
        else
        {
            $html = '<option value="">Pilih NIK 3</option>';
            $data = DB::table('data_pegawai')
                ->where('id_shift','=', $request->get('data_shift'))
                ->where('bagian','=', 'Press')
                ->where('nik','<>', $request->get('nik1'))
                ->where('nik','<>', $request->get('nik2'))
                ->get();
            //$data->where('shift','<>',$request->nik);
            foreach ($data as $datas) {
                $html .= '<option value="'.$datas->nik.'">'.$datas->nik.'-'.$datas->nama.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function getnik4(Request $request)
    {
        if (!$request->nik3 and !$request->nik2 and !$request->nik1 and !$request->data_shift)
        {
            $html = '<option value="">silahkan input nik</option>';
        }
        else
        {
            $html = '<option value="">Pilih NIK 4</option>';
            $data = DB::table('data_pegawai')
                ->where('id_shift','=', $request->get('data_shift'))
                ->where('bagian','=', 'Press')
                ->where('nik','<>', $request->get('nik1'))
                ->where('nik','<>', $request->get('nik2'))
                ->where('nik','<>', $request->get('nik3'))
                ->get();
            //$data->where('shift','<>',$request->nik);
            foreach ($data as $datas) {
                $html .= '<option value="'.$datas->nik.'">'.$datas->nik.'-'.$datas->nama.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
    public function simpan(Request $request)
    {
        $request->validate([
            'shift' => 'required',
            'nik1' => 'required',
        ]);
        $press = new Press;
        $press->tanggal=$request->tanggal;
        $press->id_shift=$request->shift;
        $press->nik1=$request->nik1;
        $press->nik2=$request->nik2;
        $press->nik3=$request->nik3;
        $press->nik4=$request->nik4;
        $press->bahan_2_0=$request->bahan_2_0;
        $press->bahan_3_1=$request->bahan_3_1;
        $press->bahan_4x8=$request->bahan_4x8;
        $press->bahan_service=$request->bahan_service;
        $press->id_user=$request->id_user;
        $press->save();
        Pesan::add('success','berhasil disimpan!!')->flash();
        return Redirect::to('/press');
        //return redirect('/press');
    }
    public function editData(Request $request,Press $press)
    {
        $request->validate([
            'id_shift' => 'required',
            'nik1' => 'required',
        ]);
        $press->update($request->all());
        /*$press = Press::find($id);
        $press->tanggal = $request->tanggal;
        $press->id_shift=$request->shift;
        $press->nik1=$request->nik1;
        $press->nik2=$request->nik2;
        $press->nik3=$request->nik3;
        $press->nik4=$request->nik4;
        $press->kode_bahan=$request->bahan;
        $press->jumlah=$request->jumlah;
        $press->id_user=$request->id_user;
        $press->save();*/
        Pesan::add('success','berhasil update!!')->flash();
        return redirect('/press');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\Data_pegawai;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Prologue\Alerts\Facades\Alert as Pesan;

class RepairController extends Controller
{
    public function ganti($id)
    {
        $repair = Repair::find($id);
        $data_pegawai =Data_pegawai::orderBy('id_shift')->pluck('id_shift', 'id_shift');
        $bahan = Bahan::where('pekerjaan','=','Repair')
            ->get();

        $nik1=Data_pegawai::where('id_shift','=',$repair->shift)
            ->get();

        $nik2 = Data_pegawai::where('id_shift','=',$repair->shift)
            ->where('nik','<>', $repair->nik1)
            ->get();



        return view('edit_repair', [
            'repair' => $repair,
            'data_pegawai' => $data_pegawai,
            'bahan' => $bahan,
            'nik1' => $nik1,
            'nik2' => $nik2,
        ]);
        /*$data=DB::table('press')->orderBy('id','desc')->paginate(10);
        $banyak_data=$data->count();
        return view('list_press')
            ->with('data',$data)
            ->with('banyak',$banyak_data);*/
    }
    public function create_repair()
    {
        if (backpack_user()->can('Transaksi'))
        {
            $data_pegawai = Data_pegawai::orderBy('id_shift')
                ->pluck('id_shift', 'id_shift');
            $bahan = Bahan::where('pekerjaan','=','Repair')
                ->get();
            return view('create_repair', [
                'data_pegawai' => $data_pegawai,
                'bahan' => $bahan,
            ]);
        }else
        {
            return view('errors.403');
        }
    }
    public function getnik1(Request $request)
    {
        if (!$request->data_shift)
        {
            $html = '<option value="">silahkan input nik</option>';
        }
        else
        {
            $html = '<option value="">Pilih NIK 1</option>';
            $data = Data_pegawai::whereIn('id_shift', [$request->get('data_shift'), 'NS'])
                ->orderBy('nik')
                ->get();
            //$data->where('shift','<>',$request->nik);
            foreach ($data as $datas) {
                $html .= '<option value="'.$datas->nik.'">'.$datas->nik.'-'.$datas->nama.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }


    public function getnik2(Request $request)
    {
        if (!$request->nik1 and !$request->data_shift)
        {
            $html = '<option value="">silahkan input nik</option>';
        }
        else
        {
            $html = '<option value="">Pilih NIK 2</option>';
            $data = Data_pegawai::whereIn('id_shift', [$request->get('data_shift'), 'NS'])
                ->where('nik','<>', $request->get('nik1'))
                ->orderBy('nik')
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
            'id_shift' => 'required',
            'nik1' => 'required',

        ]);
        $repair = new Repair();
        $repair->tanggal=$request->tanggal;
        $repair->shift=$request->id_shift;
        $repair->nik1=$request->nik1;
        $repair->nik2=$request->nik2;
        $repair->bahan_2_0=$request->bahan_2_0;
        $repair->bahan_3_1=$request->bahan_3_1;
        $repair->bahan_bc=$request->bahan_bc;
        $repair->bahan_lc_31=$request->bahan_lc_31;
        $repair->pot_2_0=$request->pot_2_0;
        $repair->pot_3_1=$request->pot_3_1;
        $repair->pot_bc=$request->pot_bc;
        $repair->pot_lc_31=$request->pot_lc_31;
        $repair->id_user=$request->id_user;
        $repair->save($request->all());
        Pesan::add('success','berhasil disimpan!!')->flash();
        return Redirect::to('/repair');
        //return redirect('/press');
    }
    public function editData(Request $request,Repair $repair)
    {
        $request->validate([
            'shift' => 'required',
            'nik1' => 'required',

        ]);
        $repair->update($request->all());
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
        return redirect('/repair');
    }
}

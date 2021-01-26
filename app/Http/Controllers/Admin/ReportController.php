<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\Laporan_press;
use App\Models\Laporan_repair;
use App\Models\Press;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Prologue\Alerts\Facades\Alert;

class ReportController extends Controller
{
    public function index()
    {
        if (backpack_user()->can('Transaksi'))
        {
            return view('range_report');
        }else
        {
            return view('errors.403');
        }

    }
    public function index2()
    {
        if (backpack_user()->can('Transaksi'))
        {
            return view('range_report_repair');
        }else
        {
            return view('errors.403');
        }

    }

    public  function menghitung(Request $request)
    {
        $request->validate([
            'tgl_awal_press' => 'required',
            'tgl_ahir_press' => 'required',
        ]);

        //DB::select('Call insertdatapegawai()');
        DB::raw('Call insertdatapegawai()');
        $data=Laporan_press::all();

        foreach ($data as $datas)
        {
            if (!empty($datas->id))
            {
                $bahan_2_0=0;
                $bahan_3_1=0;
                $bahan_4x8=0;
                $bahan_service=0;
                $total = 0;

                $nik=$datas->nik;
                $data_press=DB::table('press')
                ->whereBetween('tanggal',array($request->tgl_awal_press,$request->tgl_ahir_press))
                ->where(function ($query) use($nik){
                    $query->where('nik1','=',$nik)
                        ->orWhere('nik2','=',$nik)
                        ->orWhere('nik3','=',$nik)
                        ->orWhere('nik4','=',$nik);
                })->get();


                foreach ($data_press as $datas_press)
                {
                    $pembagi=0;
                    if (!empty($datas_press->nik1))
                    {
                        $pembagi++;
                    }
                    if (!empty($datas_press->nik2))
                    {
                        $pembagi++;
                    }
                    if (!empty($datas_press->nik3))
                    {
                        $pembagi++;
                    }
                    if (!empty($datas_press->nik4))
                    {
                        $pembagi++;
                    }
                    print_r($pembagi."</br>");
                    //print_r($datas_press->nik1);

                    if (!empty($datas_press->bahan_2_0))
                    {
                        $bahan_2_0 += ($datas_press->bahan_2_0 / $pembagi);
                    }
                    if (!empty($datas_press->bahan_3_1))
                    {
                        $bahan_3_1 += ($datas_press->bahan_3_1 / $pembagi);
                    }
                    if (!empty($datas_press->bahan_4x8))
                    {
                        $bahan_4x8 += ($datas_press->bahan_4x8 / $pembagi);
                    }
                    if (!empty($datas_press->bahan_service))
                    {
                        $bahan_service += ($datas_press->bahan_service / $pembagi);
                    }
                }
                $bahan= DB::table('bahan')
                    ->where('pekerjaan','=','Press')
                    ->get();
                //die();
                foreach ($bahan as $bahans)
                {

                    if ($bahans->kode_bahan == 'bahan_2_0')
                    {
                        $total+= ($bahan_2_0 * $bahans->harga)*($bahans->persentase/100);
                    }
                    if ($bahans->kode_bahan == 'bahan_3_1')
                    {
                        $total+= ($bahan_3_1 * $bahans->harga)*($bahans->persentase/100);
                    }
                    if ($bahans->kode_bahan == 'bahan_4x8')
                    {
                        $total+= ($bahan_4x8 * $bahans->harga)*($bahans->persentase/100);
                    }
                    if ($bahans->kode_bahan == 'bahan_service')
                    {
                        $total+= ($bahan_service * $bahans->harga)*($bahans->persentase/100);
                    }
                }

                //$dataUpdate=Laporan_press::whereIn('id',$datas->id)->get();
                //$dataUpdate=Laporan_press::find($datas->id);
                $datas->bahan_2_0=$bahan_2_0;
                $datas->bahan_3_1=$bahan_3_1;
                $datas->bahan_4x8=$bahan_4x8;
                $datas->bahan_service=$bahan_service;
                $datas->amount = $total;
                $datas->save();

            }
        }
        Alert::success('Sukses!!!')->flash();
        return Redirect::to('/laporan_press');
    }
    public  function menghitung2(Request $request)
    {
        $request->validate([
            'tgl_awal_repair' => 'required',
            'tgl_ahir_repair' => 'required',
        ]);

        //DB::select('Call insertdatapegawai2()');
        DB::raw('Call insertdatapegawai2()');
        $pegawai_repair=Laporan_repair::all();

        foreach ($pegawai_repair as $pegawai_repairs)
        {
            if (!empty($pegawai_repairs->id))
            {
                $bahan_2_0=0;
                $bahan_3_1=0;
                $bahan_bc=0;
                $bahan_lc_31=0;
                $total = 0;
                $nik=$pegawai_repairs->nik;
                $data_repairs=DB::table('repair')
                    ->whereBetween('tanggal',array($request->tgl_awal_repair,$request->tgl_ahir_repair))
                    ->where(function ($query) use($nik){
                        $query->where('nik1','=',$nik)
                            ->orWhere('nik2','=',$nik);
                    })->get();


                foreach ($data_repairs as $datas_repairs)
                {
                    $pembagi=0;
                    if (!empty($datas_repairs->nik1))
                    {
                        $pembagi++;
                    }
                    if (!empty($datas_repairs->nik2))
                    {
                        $pembagi++;
                    }

                    if (!empty($datas_repairs->bahan_2_0))
                    {
                        $bahan_2_0 += (($datas_repairs->bahan_2_0 - $datas_repairs->pot_2_0) / $pembagi);
                    }
                    if (!empty($datas_repairs->bahan_3_1))
                    {
                        $bahan_3_1 += (($datas_repairs->bahan_3_1 - $datas_repairs->pot_3_1) / $pembagi);
                    }
                    if (!empty($datas_repairs->bahan_bc))
                    {
                        $bahan_bc += (($datas_repairs->bahan_bc - $datas_repairs->pot_bc) / $pembagi);
                    }
                    if (!empty($datas_repairs->bahan_lc_31))
                    {
                        $bahan_lc_31 += (($datas_repairs->bahan_lc_31 - $datas_repairs->pot_lc_31) / $pembagi);
                    }
                }
                $bahan= DB::table('bahan')
                    ->where('pekerjaan','=','Repair')
                    ->get();
                //die();
                foreach ($bahan as $bahans)
                {

                    if ($bahans->kode_bahan == 'bahan_2_0')
                    {
                        $total+= ($bahan_2_0 * $bahans->harga);
                    }
                    if ($bahans->kode_bahan == 'bahan_3_1')
                    {
                        $total+= ($bahan_3_1 * $bahans->harga);
                    }
                    if ($bahans->kode_bahan == 'bahan_bc')
                    {
                        $total+= ($bahan_bc * $bahans->harga);
                    }
                    if ($bahans->kode_bahan == 'bahan_lc_31')
                    {
                        $total+= ($bahan_lc_31 * $bahans->harga);
                    }
                }

                $pegawai_repairs->bahan_2_0=$bahan_2_0;
                $pegawai_repairs->bahan_3_1=$bahan_3_1;
                $pegawai_repairs->bahan_bc=$bahan_bc;
                $pegawai_repairs->bahan_lc_31=$bahan_lc_31;
                $pegawai_repairs->total = $total;
                $pegawai_repairs->save();

            }
        }
        Alert::success('Sukses!!!')->flash();
        return Redirect::to('/laporan_repair');
    }
}

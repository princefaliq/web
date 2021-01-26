<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data_pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Pagination\Paginator;
use Symfony\Component\VarDumper\Cloner\Data;

class DataApi extends Controller
{
    public function index(Request $request){

        $search_term= $request->input('q');
        $form = collect($request->input('form'))->pluck('id_shift','form');
        $options = Data_pegawai::query();
       /* if (! $form['name'])
        {
            return [];
        }*/
        $options = $options->where('id_shift','=','1');
        /*if ($form['id_shift'])
        {
            $options = $options->where('id_shift',$form,'select2');

        }*/
        if ($search_term)
        {
            $result = $options->where('nik','LIKE','%'.$search_term.'%')->paginate(10);
        }
        else
        {

            $result = $options->paginate(10);
        }

        return $result;
    }

    public function index2(Request $request){

        $search_term= $request->input('q');
        $form = collect($request->input('form'))->pluck('id_shift','form');
        $options = Data_pegawai::query();
        /* if (! $form['name'])
         {
             return [];
         }*/
        $options = $options->where('id_shift','=','1');
        /*if ($form['id_shift'])
        {
            $options = $options->where('id_shift',$form,'select2');

        }*/
        if ($search_term)
        {
            $result = $options->where('nik','LIKE','%'.$search_term.'%')->paginate(10);
        }
        else
        {

            $result = $options->paginate(10);
        }

        return $result;
    }

    public function cheking($id)
    {
        return Data_pegawai::find($id);
    }

    public function show(Request $request)
    {
        $search_shift= $request->input('q');
        $page = $request->input('page');
        //$form = collect($request->input('form'))->pluck('value','name');
        $options = DB::table('data_pegawai')->groupBy('id_shift');
        /*if (! $form['id_shift'])
        {
            return [];
        }

        if ($form['id_shift'])
        {
            $options = $options->where('id_shift',data_get($form,'id_shift'));

        }*/
        if ($search_shift)
        {

            $result = $options->where('id_shift','LIKE','%'.$search_shift.'%')->paginate(10);
        }
        else
        {

            $result = $options->paginate(10);
        }
        return $result;
    }
}

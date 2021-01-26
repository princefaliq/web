<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'press';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function DataShift()
    {
        return $this->belongsTo('App\Models\shift','id_shift','id');
    }
    public function data_pegawai()
    {
        return $this->belongsTo('App\Models\Data_pegawai','nik1','nik');
    }
    public function data_pegawai2()
    {
        return $this->belongsTo('App\Models\Data_pegawai','nik2','nik');
    }
    public function data_pegawai3()
    {
        return $this->belongsTo('App\Models\Data_pegawai','nik3','nik');
    }
    public function data_pegawai4()
    {
        return $this->belongsTo('App\Models\Data_pegawai','nik4','nik');
    }
    public function bahan()
    {
        return $this->belongsTo('App\Models\Bahan','kode_bahan','kode_bahan');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

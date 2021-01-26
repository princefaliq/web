<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('data_pegawai', 'Data_pegawaiCrudController');
    Route::crud('bahan', 'BahanCrudController');
    Route::crud('press', 'PressCrudController');
    Route::crud('repair', 'RepairCrudController');
    /**
     * route pekerjaan press
     */
    //Route::get('press','PressController@list_press')->name('listPress');
    Route::get('press/create','PressController@create_press');
    //Route::get('create_press/getnik1/{id}','PressController@getnik1')->name('getnik1prees');
    Route::get('create_press/getnik1','PressController@getnik1')->name('getnik1prees');
    Route::get('create_press/getnik2','PressController@getnik2')->name('getnik2prees');
    Route::get('create_press/getnik3','PressController@getnik3')->name('getnik3prees');
    Route::get('create_press/getnik4','PressController@getnik4')->name('getnik4prees');
    Route::post('press/simpan','PressController@simpan')->name('simpanPress');
    //Route::delete('press/hapus/{id}','PressController@hapus');
    Route::get('press/{id}/edit','PressController@ganti');
    Route::put('press/Simpanedit/{press}','PressController@editData');
    /**
     * route pekerjaan repair
     */
    Route::get('repair/create','RepairController@create_repair');
    Route::get('create_repair/getnik1','RepairController@getnik1')->name('getnik1repair');
    Route::get('create_repair/getnik2','RepairController@getnik2')->name('getnik2repair');
    Route::post('repair/simpan','RepairController@simpan')->name('simpanrepair');
    //Route::delete('press/hapus/{id}','PressController@hapus');
    Route::get('repair/{id}/edit','RepairController@ganti');
    Route::put('repair/Simpanedit/{repair}','RepairController@editData');

    /**
     * route laporan press
     */
    Route::crud('laporan_press', 'Laporan_pressCrudController');
    Route::get('laporan_press/create','ReportController@index');
    Route::post('laporan_press/laporan','ReportController@menghitung');

    /**
     * route laporan repair
     */
    Route::crud('laporan_repair', 'Laporan_repairCrudController');
    Route::get('laporan_repair/create','ReportController@index2');
    Route::post('laporan_repair/laporan','ReportController@menghitung2');

}); // this should be the absolute last line of this file

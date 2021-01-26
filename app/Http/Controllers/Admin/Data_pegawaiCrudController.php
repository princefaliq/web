<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Data_pegawaiRequest;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Support\Facades\Auth;
use Prologue\Alerts\Facades\Alert;
use App\model_has_role;

/**
 * Class Data_pegawaiCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Data_pegawaiCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (backpack_user()->can('Master'))
        {
            CRUD::setModel(\App\Models\Data_pegawai::class);
            CRUD::setRoute(config('backpack.base.route_prefix') . '/data_pegawai');
            CRUD::setEntityNameStrings('Pegawai', 'Data Pegawai');
            $this->crud->enableExportButtons([
                'visibleInExport' => true,
                'visibleInTable' => true,
                'exportOnlyField' => true
            ]);
        }

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(Data_pegawaiRequest::class);
        CRUD::addfield([
            'name' => 'nik',
            'label' => 'NIK',
            'type' => 'text',
        ]);

        CRUD::addfield([
            'name' => 'nama',
            'label' => 'Nama',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'bagian',
            'label' => 'Bagian',
            'type' => 'enum',
        ]);
        CRUD::addfield([
            'name' => 'id_shift',
            'label' => 'Shift',
            'type' => 'enum',
        ]);
        CRUD::addfield([
            'name' => 'tanggal_masuk_kerja',
            'label' => 'Tanggal Masuk Kerja',
            'type' => 'date',
        ]);
        CRUD::addfield([
            'name' => 'nik_ktp',
            'label' => 'NIK KTP',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'type' => 'date',
        ]);
        CRUD::addfield([
            'name' => 'alamat',
            'label' => 'Alamat',
            'type' => 'textarea',
        ]);
        CRUD::addfield([
            'name' => 'desa',
            'label' => 'Desa',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'kecamatan',
            'label' => 'Kecamatan',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'kabupaten',
            'label' => 'Kabupaten',
            'type' => 'text',
        ]);

        //Alert::error($datas);
        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::addfield([
            'name' => 'nik',
            'label' => 'NIK',
            'type' => 'text',
        ]);

        CRUD::addfield([
            'name' => 'nama',
            'label' => 'Nama',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'bagian',
            'label' => 'Bagian',
            'type' => 'enum',
        ]);
        CRUD::addfield([
            'name' => 'id_shift',
            'label' => 'Shift',
            'type' => 'enum',
        ]);
        CRUD::addfield([
            'name' => 'tanggal_masuk_kerja',
            'label' => 'Tanggal Masuk Kerja',
            'type' => 'date',
        ]);
        CRUD::addfield([
            'name' => 'nik_ktp',
            'label' => 'NIK KTP',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'type' => 'date',
        ]);
        CRUD::addfield([
            'name' => 'alamat',
            'label' => 'Alamat',
            'type' => 'textarea',
        ]);
        CRUD::addfield([
            'name' => 'desa',
            'label' => 'Desa',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'kecamatan',
            'label' => 'Kecamatan',
            'type' => 'text',
        ]);
        CRUD::addfield([
            'name' => 'kabupaten',
            'label' => 'Kabupaten',
            'type' => 'text',
        ]);

    }
}

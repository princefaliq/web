<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RepairRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RepairCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RepairCrudController extends CrudController
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
        if (backpack_user()->can('Transaksi'))
        {
            CRUD::setModel(\App\Models\Repair::class);
            CRUD::setRoute(config('backpack.base.route_prefix') . '/repair');
            CRUD::setEntityNameStrings('repair', 'repairs');
            $this->crud->enableExportButtons([
                'visibleInExport' => true,
                'visibleInTable' => true,
                'exportOnlyField' => true
            ]);
        }else
        {
            return view('errors.403');
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
        $this->crud->addFilter([
            'type' => 'date_range',
            'name' => 'tanggal_from_to',
            'label' => 'Tanggal Antara'
        ],
            false,
            function ($value){
                $dates=json_decode($value);
                $this->crud->addClause('where','tanggal','>=', $dates->from);
                $this->crud->addClause('where','tanggal','<=',$dates->to . ' 23:59:59');
            });
        $this->crud->filters();
        /*CRUD::column('tanggal')->type('date');
        CRUD::column('shift')->type('text')->label('Shift');
        CRUD::column('NIK.nik1')->type('select')->label('NIK 1')->entity('data_pegawai')->attribute('nik')->model('App\Models\Data_pegawai');
        CRUD::column('NIK.nik2')->type('select')->label('NIK 2')->entity('data_pegawai2')->attribute('nik')->model('App\Models\Data_pegawai');
        */
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
    protected function setupShowOperation()
    {
        CRUD::column('tanggal')->type('date');
        CRUD::column('shift')->type('text')->label('Shift');
        CRUD::column('nik1')->type('select')->label('Nama NIK 1')->entity('data_pegawai')->attribute('nama')->model('App\Models\Data_pegawai');
        CRUD::column('nik2')->type('select')->label('Nama NIK 2')->entity('data_pegawai2')->attribute('nama')->model('App\Models\Data_pegawai');
    }
    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RepairRequest::class);

        CRUD::setFromDb(); // fields

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
        $this->setupCreateOperation();
    }
}

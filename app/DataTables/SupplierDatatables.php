<?php

namespace App\DataTables;

use App\Models\Supplier;
use App\Models\SupplierDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class SupplierDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_by',function($query){
                return $query->created_by ? $query->createdBy->name : 'Self-Registration' ;
            })
            ->editColumn('created_by_role',function($query){
                return $query->created_by != NULL ? ($query->createdBy->users_role == NULL ? 'Admin' : ucfirst($query->createdBy->users_role)) : 'N/A';
            })
            ->editColumn('city_id',function($query){
                return $query->supplierCity->name ? $query->supplierCity->name : 'N/A';
            })
            ->editColumn('country_id',function($query){
                return $query->supplierCountry ? $query->supplierCountry->country_name : 'N/A';
            })
            ->editColumn('status', function($query){
                if(auth()->user()->hasEditPermission($this->routeName)) {
                    return $query->status == NULL ? '<button class="btn btn-sm btn-rounded inactive btn-primary" onclick = "changeState('.$query->id.')"> Active </button>' : '<button class="btn btn-sm btn-rounded active btn-default" onclick = "changeState('.$query->id.')">Inactive</button>';
                }
            })
            ->rawColumns(['status'])
            ->addColumn('action',function ($query){
                return view('mains.suppliers.action')->with(['model' => $query,'routeName' => $this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SupplierDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
    {

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('supplierdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('company_contact'),
            Column::make('address'),
            Column::make('city_id'),
            Column::make('country_id'),
            Column::make('status')->title('Active / Inactive'),
            Column::make('created_by'),
            Column::make('created_by_role'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SupplierDatatables_' . date('YmdHis');
    }
}

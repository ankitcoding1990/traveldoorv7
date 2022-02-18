<?php

namespace App\DataTables;

use App\Models\Services;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ServiceMasterDatatables extends DataTable
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
            ->editColumn('country_id', function($model) {
                return !empty($model->country_id) ? $model->country->country_name : "";
            })
            ->editColumn('city_id', function($model) {
                return !empty($model->city_id) ? $model->city->name : "";
            })
            ->editColumn('service_status', function($query){
                return view('mains.masters.service_master.status', ['model' => $query]);
            })
            ->addColumn('action', function ($query){
                return view('mains.masters.service_master.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            });
            // ->addColumn('action', 'mains.masters.service_master.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\ServiceMasterDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Services $model)
    {
        if(request()->has('inactive')){
            $query = $model->onlyTrashed()->newQuery();
        }else{
            $query = $model->newQuery();
        }
        
        if ($this->user_id != null) {
            $query = $query->where('service_created_by', $this->user_id);
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('servicemasterdatatables-table')
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
            Column::make('id')->title('Id'),
            Column::make('service_name')->title('Name'),
            Column::make('service_description')->title('Description'),
            Column::make('country_id')->title('Country'),
            Column::make('city_id')->title('City'),
            Column::make('service_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ServiceMasterDatatables_' . date('YmdHis');
    }
}

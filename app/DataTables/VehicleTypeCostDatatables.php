<?php

namespace App\DataTables;

use App\App\VehicleTypeCostDatatable;
use App\Models\VehicleWiseCost;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class VehicleTypeCostDatatables extends DataTable
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
            ->addColumn('action', function($model){
                return view('mains.masters.vehicle_type_cost.action')->with(['routeName' => $this->routeName, 'model' => $model]);
            })
            ->addColumn('vehicle_type_name',function($model){
                return !empty($model->vehicleTypes) ? $model->vehicleTypes->vehicle_type_name : "";
             });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\VehicleTypeCostDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VehicleWiseCost $model)
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
                    ->setTableId('vehicletypecostdatatables-table')
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
            Column::make('vehicle_type_name')->title('Vehicle Type'),
            Column::make('vehicle_type_cost')->title('Cost'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'VehicleTypeCostDatatables_' . date('YmdHis');
    }
}

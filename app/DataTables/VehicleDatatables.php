<?php

namespace App\DataTables;

use App\Models\Vehicles;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class VehicleDatatables extends DataTable
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
            ->editColumn('vehicle_type_id',function($query){
                return !empty($query->vehicle_type) ? $query->vehicle_type->vehicle_type_name : "";
            })
            ->editColumn('vehicle_status',function($query){
                return view('mains.masters.vehicle.status', ['model' => $query]);
            })
            // ->rawColumns(['vehicle_status','action'])
            ->addColumn('action', function ($query){
                return view('mains.masters.vehicle.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\VehicleDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vehicles $model)
    {
        $query = $model->withTrashed()->newQuery();
        if ($this->user_id != null) {
            $query = $query->where('vehicle_created_by', $this->user_id);
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
                    ->setTableId('vehicledatatables-table')
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
            Column::make('vehicle_type_id')->title('Vehicle Type Name'),
            Column::make('vehicle_name')->title('Vehicle Name'),
            Column::make('vehicle_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'VehicleDatatables_' . date('YmdHis');
    }
}

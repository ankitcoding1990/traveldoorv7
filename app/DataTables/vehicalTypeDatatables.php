<?php

namespace App\DataTables;

use App\Models\VehicleType;
use App\App\vehicalDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class vehicalTypeDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected  $count = 1;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('#', function(){
                return $this->count++;
            })
            ->editColumn('vehicle_type_image', function($query){
                return "<img src='$query->image_full_path' />";
              })
            ->rawColumns(['vehicle_type_image','action','vehicle_type_status'])
            ->addColumn('action', function ($query){
                return view('mains.masters.vehicle_type.actions')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->editColumn('vehicle_type_status',function($query){
                return $query->vehicle_type_status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeState('.$query->id.',`inactive`)">Active</button>':'<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeState('.$query->id.',`active`)">Inactive</button>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\vehicalDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VehicleType $model)
    {
        if ($this->user_id != null) {
            $query = $model->where('vehicle_type_created_by', $this->user_id);
        } else {
            $query = $model->newQuery();
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
                    ->setTableId('vehicaldatatables-table')
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
            Column::make('#'),
            Column::make('vehicle_type_name')->title('Name'),
            Column::make('vehicle_type_min')->title('Min Pax'),
            Column::make('vehicle_type_max')->title('Max Pax'),
            Column::make('vehicle_type_image')->title('Image'),
            Column::make('vehicle_type_status')->title('Status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'vehicalDatatables_' . date('YmdHis');
    }
}

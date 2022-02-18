<?php

namespace App\DataTables;

use App\Models\TransferMaster;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class TransferMasterDatatable extends DataTable
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
            ->editColumn('master_country',function ($model){
                return !empty($model->country) ? $model->country->country_name : "Not Available";
            })
            ->editColumn('master_city',function ($model){
                return !empty($model->city) ? $model->city->name : "Not Available";
            })
            ->addColumn('action', function ($query){
                return view('mains.masters.transfer_master.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->editColumn('master_status',function($query){
                return $query->master_status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeState('.$query->id.',`inactive`)">Active</button>' : '<button class="btn btn-default btn-sm btn-rounded" onclick="ChangeState('.$query->id.',`active`)">Inactive</button>';
            })
            ->rawColumns(['action', 'master_status']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\TransferMasterDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TransferMaster $model)
    {
        if ($this->user_id != null) {
            $query = $model->where('master_created_by', $this->user_id);
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
                    ->setTableId('transfermasterdatatable-table')
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
            Column::make('master_name')->title('Name'),
            Column::make('master_country')->title('Country'),
            Column::make('master_city')->title('City'),
            Column::make('master_type'),
            Column::make('master_status')->title('status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TransferMaster_' . date('YmdHis');
    }
}

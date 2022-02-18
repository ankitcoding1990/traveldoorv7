<?php

namespace App\DataTables;

use App\Models\SettingTargetCommission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class TargetCommissionDatatables extends DataTable
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
            ->addColumn('action', function($query){
                return view('mains.masters.target_commission.action')->with(['model' => $query,'routeName' => $this->routeName]);
            })
            ->editColumn('st_commission_per',function($query){
                return $query->st_commission_per. '%';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\TargetCommissionDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SettingTargetCommission $model)
    {
        if ($this->user_id != null || isset($this->user_id)) {
            $query = $model->where('st_created_by',$this->user_id);
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
                    ->setTableId('targetcommissiondatatables-table')
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
            Column::make('st_amount')->title('Target Amount'),
            Column::make('st_commission_per')->title('Commission (in %)'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TargetCommissionDatatables_' . date('YmdHis');
    }
}

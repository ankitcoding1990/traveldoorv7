<?php

namespace App\DataTables;

use App\Models\CustomerMarkup;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class CustomerMarkupDatatables extends DataTable
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
            ->editColumn('customer_markup_cost',function($query){
                return $query->customer_markup_cost . '%';
            })
            ->addColumn('action',function ($query)
            {
                return view('mains.masters.customer_markup.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\CustomerMarkupDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CustomerMarkup $model)
    {
        if ($this->user_id != null || isset($this->user_id)) {
            $query = $model->where('customer_markup_created_by',$this->user_id);
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
                    ->setTableId('customermarkupdatatables-table')
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
            Column::make('customer_markup')->title('Markup'),
            Column::make('customer_markup_cost')->title('Cost(in %)'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CustomerMarkupDatatables_' . date('YmdHis');
    }
}

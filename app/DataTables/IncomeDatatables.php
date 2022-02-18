<?php

namespace App\DataTables;

use App\Models\IncomeExpenseCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;

class IncomeDatatables extends DataTable
{
    public function __construct($count = 1)
    {
        $this->count = $count;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($query){
                return view('mains.IncomeExpense.IncomeCategory.action')->with(['model'=>$query, 'routeName'=>$this->routeName]);
            })
            ->addColumn('SR_NO',function (){
                return $this->count++;
            });
    }

    public function query(IncomeExpenseCategory $model)
    {
        return $model::where('expense_category_type','income');
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('incomedatatables-table')
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

    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
                  Column::make('SR_NO'),
                  Column::make('expense_category_name')->title('Name'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Income_' . date('YmdHis');
    }
}

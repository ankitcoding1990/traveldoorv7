<?php

namespace App\DataTables;

use App\Models\IncomeExpenseCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpenseDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function __construct($count = 1)
    {
        $this->count = $count;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($query){
              return view('mains.IncomeExpense.ExpenseCategory.action')->with(['model'=>$query, 'routeName'=>$this->routeName]);
            })            
            ->addColumn('SR_NO',function (){
                return $this->count++;
            });
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\IncomeExpenseDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(IncomeExpenseCategory $model)
    {
        return $model::where('expense_category_type','expense');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('incomeexpensedatatable-table')
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
        return 'IncomeExpense_' . date('YmdHis');
    }
}

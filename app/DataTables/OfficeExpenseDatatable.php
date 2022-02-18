<?php

namespace App\DataTables;

use App\Models\Expense;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class OfficeExpenseDatatable extends DataTable
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
            return view('mains.IncomeExpense.officeexpense.action')->with(['model'=>$query, 'routeName'=>$this->routeName]);
        })
        ->addColumn('SR_NO',function (){
            return $this->count++;
        })
        ->addColumn('expense_category_id',function($model){
            return !empty($model->expense_category_id) ? $model->get_expense_category->expense_category_name : "";
         })
         ->addColumn('expense_amount',function ($model)
         {
             return !empty($model->expense_amount) ? 'GEL '.$model->expense_amount : '';
         });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\OfficeExpenseDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
    {
        return $model->orderBy('created_at','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('officeexpensedatatable-table')
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
            Column::make('expense_category_id')->title('Expense Category'),
            Column::make('expense_occured_on')->title('Occured On'),
            Column::make('expense_amount')->title('Amount'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OfficeExpense_' . date('YmdHis');
    }
}

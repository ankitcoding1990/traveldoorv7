<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use App\Models\Income;

class OfficeIncomeDatatable extends DataTable
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
                return view('mains.IncomeExpense.officeincome.action')->with(['model'=>$query, 'routeName'=>$this->routeName]);
            })    
            ->addColumn('SR_NO',function (){
                return $this->count++;
            })
            ->addColumn('incomes_category_id',function($model){
                return !empty($model->incomes_category_id) ? $model->get_income_category->expense_category_name : "";
             })
             ->addColumn('incomes_amount',function ($model)
             {
                 return !empty($model->incomes_amount) ? 'GEL '.$model->incomes_amount : '';
             });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\OfficeIncomeDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Income $model)
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
                    ->setTableId('officeincomedatatable-table')
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
            Column::make('incomes_category_id')->title('Income Category'),
            Column::make('incomes_occured_on')->title('Occured On'),
            Column::make('incomes_amount')->title('Amount'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OfficeIncome_' . date('YmdHis');
    }
}

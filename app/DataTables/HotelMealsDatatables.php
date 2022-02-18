<?php

namespace App\DataTables;

use App\Models\HotelMeal;
use App\App\HotelMealsDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class HotelMealsDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $count = 1;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('#',function(){
                return $this->count++;
            })
            ->editColumn('hotel_meals_status', function($query){
                return view('mains.masters.hotel_meal.status')->with(['model' => $query]);
            })
            ->addColumn('action' ,function($query){
                return view('mains.masters.hotel_meal.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->rawColumns(['hotel_meals_status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\HotelMealsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HotelMeal $model)
    {
        if(request()->has('inactive')){
            $query = $model->onlyTrashed()->newQuery();
        }else{
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
                    ->setTableId('hotelmealsdatatables-table')
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
            Column::make('hotel_meals_name')->title('Meals Name'),
            Column::make('hotel_meals_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HotelMealsDatatables_' . date('YmdHis');
    }
}

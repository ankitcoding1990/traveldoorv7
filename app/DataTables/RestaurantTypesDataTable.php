<?php

namespace App\DataTables;

use App\Models\RestaurantType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class RestaurantTypesDataTable extends DataTable
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

            ->editColumn('restaurant_type_created_by', function($query){
                return $query->user->name;
            })
            ->editColumn('restaurant_type_status', function($query){
                return view('mains.restaurants.restaurant_type.status', ['model' => $query]);
            })
            ->addColumn('action', function($query){
                return view('mains.restaurants.restaurant_type.action')->with(['model'=>$query, 'routeName'=>$this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\RestaurantType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RestaurantType $model)
    {
        $query = $model->withTrashed()->newQuery();
        if ($this->user_id != null) {
            $query = $query->where('restaurant_type_created_by', $this->user_id);
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
                    ->setTableId('restauranttypes-table')
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
            Column::make('id'),
            Column::make('restaurant_type_name')->title('Type Name'),
            Column::make('restaurant_type_status')->title('Status'),
            Column::make('restaurant_type_created_by')->title('Created By'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'RestaurantTypes_' . date('YmdHis');
    }
}

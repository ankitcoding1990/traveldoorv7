<?php

namespace App\DataTables;

use App\Models\RestaurantMenuCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class RestaurantMenuCategoryDataTable extends DataTable
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

            ->editColumn('created_by', function($query){
                return $query->user->name;
            })
            ->editColumn('status', function($query){
                return view('mains.restaurants.restaurant_menu.status', ['model' => $query]);
            })
            ->addColumn('action', function($query){
                return view('mains.restaurants.restaurant_menu.action')->with(['model'=>$query, 'routeName'=>$this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\RestaurantMenuCategoryDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RestaurantMenuCategory $model)
    {
        $query = $model->withTrashed()->newQuery();
        if ($this->user_id != null) {
            $query = $query->where('created_by', $this->user_id);
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
                    ->setTableId('restaurantmenucategorydatatable-table')
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
            Column::make('name'),
            Column::make('description'),
            Column::make('status'),
            Column::make('created_by'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'RestaurantMenuCategory_' . date('YmdHis');
    }
}

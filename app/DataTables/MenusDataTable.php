<?php

namespace App\DataTables;

use App\Models\Menu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class MenusDataTable extends DataTable
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
            ->addColumn('menu_pid', function($query){
                if($query->menu != null)
                    return $query->menu->menu_name;
            })
            ->addColumn('user_id', function($query){
                if($query->user != null)
                    return $query->user->name;
            })
            ->editColumn('status', function($query){
                return view('mains.user-management.menus.status', ['model' => $query]);
            })
            ->addColumn('updated_at', function($query){
                return $query->updated_at->toDayDateTimeString();
            })
            ->addColumn('action', 'mains.user-management.menus.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Menu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model)
    {
        return $model->withTrashed()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('menus-table')
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
            Column::make('menu_name'),
            Column::make('menu_file'),
            Column::make('menu_pid'),
            Column::make('menu_file'),
            Column::make('user_id'),
            Column::make('status'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Menus_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\ActivityType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ActivityTypeDatatables extends DataTable
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
            ->editColumn('activity_type_status', function($query){
                return view('mains.masters.activity_type.status', ['model' => $query]);
            })
            ->addColumn('activity_type_created_by', function($query){
                return $query->user->name;
            })
            ->addColumn('action', function ($query){
                
                return view('mains.masters.activity_type.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Models\ActivityTypeDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityType $model)
    {
        if(request()->has('inactive')){
            $query = $model->onlyTrashed()->newQuery();
        }else{
            $query = $model->newQuery();
        }
        
        if ($this->user_id != null) {
            $query = $query->where('activity_type_created_by', $this->user_id);
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
                    ->setTableId('activitytypedatatables-table')
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
            Column::make('activity_type_name')->title('Name'),
            Column::make('activity_type_created_by')->title('Created By'),
            Column::make('activity_type_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ActivityTypeDatatables_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Languages;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
class LanguagesDataTable extends DataTable
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
            ->editColumn('updated_at', function($query){
              return $query->updated_at->toDayDateTimeString();
            })
            ->editColumn('status', function($query){
              return view('mains.masters.languages.status')->with(['model' => $query]);
              // return $query->status ? '<button class="btn btn-success btn-sm btn-rounded" onclick="ChangeState('.$query->id.', `inactive`)">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeState('.$query->id.', `active`)">Inactive</button>';
            })
            ->addColumn('action', function($query){
                return view('mains.masters.languages.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Language $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Languages $model)
    {   
        if(request()->has('inactive')){
            $query = $model->onlyTrashed()->newQuery();
        }else{
            $query = $model->newQuery();
        }

        if ($this->user_id != null) {
            $query = $query->where('language_created_by', $this->user_id);
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
                    ->setTableId('languages-table')
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
            Column::make('language_name'),
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
        return 'Languages_' . date('YmdHis');
    }
}

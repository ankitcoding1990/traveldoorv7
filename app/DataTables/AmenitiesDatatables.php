<?php

namespace App\DataTables;

use App\Models\Amenities;
use App\App\AmenitiesDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AmenitiesDatatables extends DataTable
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
            ->editColumn('amenities_status', function($query){
                if(auth()->user()->hasEditPermission($this->routeName)) {
                    return view('mains.masters.amenities.status')->with(['model' => $query]);
                }
            })
            ->rawColumns(['amenities_status','action'])
            ->addColumn('action', function ($query){
                return view('mains.masters.amenities.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\AmenitiesDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Amenities $model)
    {
        if(request()->has('inactive')){
            $query = $model->onlyTrashed()->newQuery();
        }else{
            $query = $model->newQuery();
        }

        if ($this->user_id != null) {
            $query = $query->where('amenities_created_by', $this->user_id);
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
                    ->setTableId('amenitiesdatatables-table')
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
            Column::make('amenities_name')->title('name'),
            Column::make('amenities_status')->title('Active / Inactive'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AmenitiesDatatables_' . date('YmdHis');
    }
}

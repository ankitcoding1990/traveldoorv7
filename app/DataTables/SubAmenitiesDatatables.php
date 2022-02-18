<?php

namespace App\DataTables;

use App\Models\SubAmenities;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class SubAmenitiesDatatables extends DataTable
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
            ->editColumn('amenities_name',function($query){
                return !empty($query->amenities) ? $query->amenities->amenities_name : "";
            })
            ->editColumn('sub_amenities_status',function($query){
                if(auth()->user()->hasEditPermission($this->routeName)) {
                    return view('mains.masters.sub_amenities.status')->with(['model' => $query]);
                }
            })
            ->rawColumns(['sub_amenities_status','action'])
            ->addColumn('action', function ($query){
                return view('mains.masters.sub_amenities.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\SubAmenitiesDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubAmenities $model)
    {
        if(request()->has('inactive')){
            $query = $model->onlyTrashed()->newQuery();
        }else{
            $query = $model->newQuery();
        }

        if ($this->user_id != null) {
            $query = $model->where('sub_amenities_created_by', $this->user_id);
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
                    ->setTableId('subamenitiesdatatables-table')
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
            Column::make('id')->title('ID'),
            Column::make('amenities_name')->title('Amenities Name'),
            Column::make('sub_amenities_name')->title('Sub Amenities Name'),
            Column::make('sub_amenities_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SubAmenitiesDatatables_' . date('YmdHis');
    }
}

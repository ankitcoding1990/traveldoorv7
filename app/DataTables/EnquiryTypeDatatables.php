<?php

namespace App\DataTables;

use App\App\EnquiryTypeDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use App\Models\EnquiryType;

class EnquiryTypeDatatables extends DataTable
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
            ->addColumn('action', function ($query){
                return view('mains.masters.enquiry_type.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->editColumn('enquiry_type_status', function($query){
                return view('mains.masters.enquiry_type.status')->with(['model' => $query]);
            })
            ->rawColumns(['action', 'enquiry_type_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\EnquiryTypeDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EnquiryType $model)
    {
        $query = $model->withTrashed()->newQuery();
        if ($this->user_id != null) {
            $query = $query->where('enquiry_type_created_by', $this->user_id);
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
                    ->setTableId('enquirytypedatatables-table')
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
            Column::make('enquiry_type_name')->title('Name'),
            Column::make('enquiry_type_status')->title('status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'EnquiryTypeDatatables_' . date('YmdHis');
    }
}

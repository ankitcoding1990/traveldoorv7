<?php

namespace App\DataTables;

use App\Models\Agent;
use App\Models\ItineraryPdf;
use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class PdfMasterDatatable extends DataTable
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
            ->addColumn('action', function ($query){
                return view('mains.masters.pdf_master.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->editColumn('pdf_status',function ($query){
                if (auth()->user()->hasEditPermission($this->routeName)) {
                    return $query->pdf_status ? '<button class="btn btn-sm btn-rounded inactive btn-primary" onclick = "changeState('.$query->id.')"> Active </button>' : '<button class="btn btn-sm btn-rounded active btn-default" onclick = "changeState('.$query->id.')">Inactive</button>';
                }
            })
            ->editColumn('created_by_role',function($query){
                return ucfirst($query->created_by_role);
            })
            ->editColumn('created_by',function($query){
               if($query->created_by_role == 'agent'){
                   $data = Agent::where('agent_id',$query->created_by)->first();
                   return $data->agent_name;
               }
               else{
                    $data = User::where('id',$query->created_by)->first();
                    return $data->Fullname;
               }
            })
            ->editColumn('about_text',function($query){
                return (strlen($query->about_text) > 30) ? substr($query->about_text, 0, 30) . '...' : $query->about_text;
            })
            ->rawColumns(['pdf_status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\PdfMasterDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItineraryPdf $model)
    {
        if ($this->user_id != null) {
            $query = $model->where('created_by', $this->user_id)->orderBy('id');
        } else {
            $query = $model->orderBy('id');
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
                    ->setTableId('pdfmasterdatatable-table')
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
            Column::make('title'),
            Column::make('about_text')->title('Description'),
            Column::make('created_by')->title('Created by'),
            Column::make('created_by_role')->title('Role'),
            Column::make('pdf_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PdfMaster_' . date('YmdHis');
    }
}

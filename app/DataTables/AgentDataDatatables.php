<?php

namespace App\DataTables;

use App\Models\Agent;
use PHPUnit\Framework\Constraint\Count;
use Psy\Command\EditCommand;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AgentDataDatatables extends DataTable
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
            ->editColumn('created_user_id', function($query){
                return !empty($query->created_user_id) ? $query->createdBy->name : 'Self'; 
            })
            ->editColumn('city_id', function($query){
                return !empty($query->city_id) ? $query->city->name : 'N/A';
            })
            ->editColumn('country_id', function($query){
                return !empty($query->country_id) ? $query->country->country_name : 'N/A';
            })
            ->editColumn('status', function($query){
                if(auth()->user()->hasEditPermission($this->routeName)){
                    return $query->status != Null ? '<button type="button" class="btn btn-sm btn-secondary inactive btn-rounded" onclick="changeState('.$query->id.')">Inactive</button>' : '<button type="button" class="btn btn-sm btn-rounded active btn-primary" onclick="changeState('.$query->id.')">Active</button>';
                }
            })
            ->rawColumns(['status'])
            ->addColumn('action', function($query){
                return view('mains.agents.action')->with(['model' => $query, 'routeName' => $this->routeName]);
                
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Agent $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Agent $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('agentdatadatatables-table')
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
            Column::make('id')->title('#'),
            Column::make('name'),
            Column::make('company_contact'),
            Column::make('address'),
            Column::make('city_id')->title('City'),
            Column::make('country_id')->title('country'),
            Column::make('status'),   
            Column::make('created_user_id')->title('Created By')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AgentDataDatatables_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\ActivityType;
use App\Models\Activity;
use App\Models\Countries;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ActivityServiceDatatable extends DataTable
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
            ->addColumn('#',function($query){
                return $this->count++;
            })
            ->addColumn('action',function($query){
                return view('service-management.activities.action')->with(['model' => $query, 'routeName' => $this->routeName,'filter' => $this->filter]);
            })
            ->editColumn('activity_type_id',function($model){
                return !empty($model->activityType) ? $model->activityType->activity_type_name : "";
            })
            ->editColumn('country_id', function($model) {
                return !empty($model->country) ? $model->country->country_name : "";
            })
            ->editColumn('city_id', function($model) {
                return !empty($model->city) ? $model->city->name : "";
            })
            ->editColumn('status',function($query){
                return view('service-management.activities.status', ['model' => $query]);
            })
            ->editColumn('approve_status',function($query){
                return $query->approve_status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeColumnState(`approve_status`,'.$query->id.',`inactive`)" type="button">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeColumnState(`approve_status`,'.$query->id.',`active`)" type="button">Inactive</button>';
            })
            ->editColumn('best_seller',function($query){
                return $query->best_seller == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeColumnState(`best_seller`,'.$query->id.',`inactive`)" type="button">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeColumnState(`best_seller`,'.$query->id.',`inactive`)" type="button">Inactive</button>';
            })
            ->rawColumns(['action','status','approve_status','best_seller']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivityServiceDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Activity $model)
    {
        $query = $model->withTrashed()->newQuery();
        if($this->filter == 'undrafted')
            $query->where('draft_status','0');
        else
            $query->where('draft_status','1');
        if($this->isSupplier != null)
            $query->Where('supplier_id', $this->user_id ?? auth()->guard('supplier')->id());

        if($this->user_id != null && $this->isSupplier == null)
            $query->where('created_user_id',$this->user_id);
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
                    ->setTableId('activityservicedatatable-table')
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
                  ->width(100)
                  ->addClass('text-center'),
            Column::make('#'),
            Column::make('name'),
            Column::make('activity_type_id')->title('Activity Type'),
            Column::make('location'),
            Column::make('country_id')->title('Country'),
            Column::make('city_id')->title('City'),
            Column::make('status'),
            Column::make('approve_status')->title('Approved'),
            Column::make('best_seller'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ActivityService_' . date('YmdHis');
    }
}

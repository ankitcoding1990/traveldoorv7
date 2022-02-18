<?php

namespace App\DataTables;

use App\Models\Restaurants;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class RestaurantsDataTable extends DataTable
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
            ->addColumn('action', function($query){
                return view('mains.restaurants.restaurant_management.action')->with(['model'=>$query, 'routeName'=>$this->routeName, 'isSupplier'=>$this->isSupplier]);
            })
            ->editColumn('city_id', function($model) {
                return !empty($model->city_id) ? $model->getCity->name : "";
            })
            ->editColumn('country_id', function($model) {
                return !empty($model->country_id) ? $model->getCountry->country_name : "";
            })
            ->editColumn('supplier_id', function($model) {
                return !empty($model->supplier_id) ? $model->getSupplier->name : "";
            })
            ->editColumn('status', function($query){
                return view('mains.restaurants.restaurant_management.status', ['model' => $query]);
            })->editColumn('approve_status', function($query){
                return $query->approve_status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeColumnState(`approve_status`,'.$query->id.',`inactive`)" type="button">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeColumnState(`approve_status`,'.$query->id.',`active`)" type="button">Inactive</button>';
                // return $query->approve_status ==0 ? '<button type="button" class="btn btn-info btn-sm btn-rounded activeOrInactive-button" onclick="ChangeColumnState(`approve_status`,'.$query->id.', `active`)">Inactive</button>' : '<button type="button" class="btn btn-info btn-sm btn-rounded activeOrInactive-button" onclick="ChangeColumnState(`approve_status`,'.$query->id.', `inactive`)">Active</button>';
            })
            ->rawColumns(['action','status','approve_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Restaurant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Restaurants $model)
    {
        $query=$model->withTrashed()->newQuery();
        if($this->filter == 'undrafted')
            $query->where('drafted_status','0');
        else
            $query->where('drafted_status','1');

        if($this->isSupplier){
            $query->where(function($subquery) {
                $subquery->where('created_supplier_id',auth()->guard('supplier')->user()->id)
                      ->orWhere('supplier_id',auth()->guard('supplier')->user()->id);
            });
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
                    ->setTableId('restaurants-table')
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
            Column::make('address'),
            Column::make('contact'),
            Column::make('city_id')->title('City'),
            Column::make('country_id')->title('Country'),
            Column::make('supplier_id')->title('Supplier'),
            Column::make('status'),
            Column::make('approve_status')->title('Approval')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Restaurants_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Coupon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class CouponsDatatable extends DataTable
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
                return view('mains.masters.coupon.action')->with(['model' => $query, 'routeName' => $this->routeName]);
            })
            ->editColumn('coupan_status',function ($query){
                if (auth()->user()->hasEditPermission($this->routeName)) {
                    return $query->coupan_status ? '<button class="btn btn-sm btn-rounded inactive btn-primary" onclick = "changeState('.$query->id.')"> Active </button>' : '<button class="btn btn-sm btn-rounded active btn-default" onclick = "changeState('.$query->id.')">Inactive</button>';
                }
            })
            ->rawColumns(['coupan_status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\CouponsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
    {
        if ($this->user_id != null) {
            $query = $model->where('coupan_created_by', $this->user_id);
        } else {
            $query = $model->newQuery();
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
                    ->setTableId('couponsdatatable-table')
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
            Column::make('coupan_name')->title('Name'),
            Column::make('coupan_type'),
            Column::make('coupan_validity_from')->title('Validate From'),
            Column::make('coupan_validity_to')->title('Validate To'),
            Column::make('coupan_amount_type')->title('Amount Type'),
            Column::make('coupan_amount')->title('Amount'),
            Column::make('coupan_status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Coupons_' . date('YmdHis');
    }
}

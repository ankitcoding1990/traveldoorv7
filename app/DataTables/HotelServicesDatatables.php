<?php

namespace App\DataTables;

use App\Models\Hotel;
use App\Models\HotelServicesDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class HotelServicesDatatables extends DataTable
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
            ->editcolumn('hotel_type_id', function($query){
                $hotelType = "";
            if ($query->hotel_type_id != null) {
                $hotelType = !empty($query->hotelType) ? $query->hotelType->hotel_type_name  : '';
            }
            return $hotelType;
            })
            ->editcolumn('supplier_id', function($query){
                $supplierName = "";
            if ($query->supplier_id != null) {
                $supplierName = !empty($query->supplier) ? $query->supplier->name  : '';
            }
            return $supplierName;
            })
            ->editColumn('created_admin_id', function($query) {
                $value = "";
                if($query->created_admin_id != null){
                    $value = !empty($query->admin) ? $query->admin->name.'(admin)' : '';
                }
                return $value;
            })
            ->editColumn('status',function($query){
                return $query->status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeColumnState(`status`,'.$query->id.',`inactive`)" type="button">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeColumnState(`status`,'.$query->id.',`active`)" type="button">Inactive</button>';
            })
            ->editColumn('best_status',function($query){
                return $query->best_status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeColumnState(`best_status`,'.$query->id.',`inactive`)" type="button">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeColumnState(`best_status`,'.$query->id.',`active`)" type="button">Inactive</button>';
            })
            ->editColumn('popular_status',function($query){
                return $query->popular_status == 1 ? '<button class="btn btn-info btn-sm btn-rounded" onclick="ChangeColumnState(`popular_status`,'.$query->id.',`inactive`)" type="button">Active</button>' : '<button class="btn btn-secondary btn-sm btn-rounded" onclick="ChangeColumnState(`popular_status`,'.$query->id.',`active`)" type="button">Inactive</button>';
            })
            ->editColumn('admin_approval',function($query){
                if(auth()->user()){
                    if($query->admin_approval == 0) { $pending =  "selected"; }else{ $pending = "";}
                    if($query->admin_approval == 1) { $approved =  "selected"; }else{ $approved = "";}
                    if($query->admin_approval == 2) { $block =  "selected"; }else{ $block = "";}
                   return '<select class="form-control" onchange="AdminApproval(`admin_approval`,'.$query->id.',(this.value))">
                    <option value="pending" '.$pending.'>Pending</option>
                    <option value="approved" '.$approved.'>Approved</option>
                    <option value="block" '.$block.'>Block</option>
                    </select>';
                }else{
                if($query->admin_approval == 0) {
                   return '<span class="btn btn-secondary btn-rounded btn-sm">Pending</span>';
                } else if($query->admin_approval == 1){
                   return '<span class="btn btn-info btn-rounded btn-sm">Approved</span>';
                } else if($query->admin_approval == 2){
                   return '<span class="btn btn-danger btn-rounded btn-sm" style="background:#ff0000; border: 1px solid #ff0000">Blocked</span>';
                }
            }
            })
            ->addColumn('action', function($model){
                return view('service-management.hotels.action')->with(['model' => $model, 'routeName' => $this->routeName,'filter' => $this->filter]);
            })
            ->rawColumns(['action','status','best_status','popular_status','admin_approval']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HotelServicesDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hotel $model)
    {
        if ($this->filter == 'drafted') {
            if ($this->user_id && $this->isSupplier) {
                $query = $model->where('supplier_id', $this->user_id)->where('draft_status', '1');
            } else {
                $query = $model->where('draft_status', '1');
            }
        } else {
            if ($this->user_id  && $this->isSupplier) {
                $query = $model->where('supplier_id', $this->user_id)->where('draft_status', '0');
            } else {
                $query = $model->where('draft_status', '0');
            }
        }
        return $query->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('hotelservicesdatatables-table')
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
            Column::make('hotel_name')->title('Hotel Name'),
            Column::make('hotel_type_id')->title('Type'),
            Column::make('hotel_contact')->title('Contact'),
            Column::make('location')->title('Location'),
            Column::make('supplier_id')->title('Supplier'),
            Column::make('created_admin_id')->title('Created By'),
            Column::make('status')->title('Status'),
            Column::make('best_status')->title('Best Status'),
            Column::make('popular_status')->title('Popular'),
            Column::make('admin_approval')->title('Approval'),
            Column::make('created_at'),
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
        return 'HotelServicesDatatables_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class UsersDataTable extends DataTable
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
            ->editColumn('users_status', function($query){
              return view('mains.user-management.users.status', ['model' => $query]);
              return $query->users_status == null ? 'Inactive' : 'Active';
            })
            ->editColumn('users_role', function($query){
              if ($query->isAdmin()) {
                return 'Admin';
              }else{
                if ($query->users_role == 'subuser') {
                  return 'User';
                }else if($query->users_role == 'partner'){
                  return 'Partner';
                }
              }

            })
            ->addColumn('action', 'mains.user-management.users.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('users-table')
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
                  ->width(130)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('users_role'),
            Column::make('name'),
            Column::make('email'),
            Column::make('users_pid'),
            Column::make('users_empcode'),
            Column::make('users_assigned_role'),
            Column::make('users_contact'),
            Column::make('users_status'),
          ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
